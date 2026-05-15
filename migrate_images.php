<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Realisation;

$projects = Realisation::all();

foreach($projects as $project) {
    if($project->image_path && strpos($project->image_path, 'storage/') !== false) {
        $old_path = public_path($project->image_path);
        $filename = basename($project->image_path);
        $new_path = public_path('uploads/realisations/' . $filename);
        
        if(file_exists($old_path)) {
            copy($old_path, $new_path);
            $project->image_path = 'uploads/realisations/' . $filename;
            $project->save();
            echo "Migré: " . $project->title . " - " . $filename . "<br>";
        } else {
            echo "Fichier non trouvé: " . $old_path . "<br>";
        }
    }
}

echo "<br>Migration terminée !";