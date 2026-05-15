<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministrationController;
use App\Http\Controllers\Admin\SolutionController;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategorieSolutionController;
use App\Http\Controllers\Admin\PartenaireController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\ContactController;


use App\Http\Controllers\Admin\RealisationController;
use App\Models\CategorieSolution;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WebsiteController::class, 'index'])->name('accueil');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/services', [WebsiteController::class, 'services'])->name('services');

Route::get('/realisations', [WebsiteController::class, 'realisations'])->name('realisations');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/service/{slug}', [WebsiteController::class, 'serviceDetails'])->name('service.details');
Route::get('/services/category/{slug}', [WebsiteController::class, 'servicesByCategory'])->name('services.by.category');

Route::get('/realisation/{id}', [WebsiteController::class, 'realisationDetails'])->name('realisation.details');

Auth::routes();

Route::prefix('administration')->middleware(['auth'])->name('administration.')->group(function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('dashboard');

    Route::resource('banners', BannerController::class);

    Route::resource('categories', CategorieSolutionController::class)->except(['show']);
    Route::patch('categories/{category}/toggle-status', [CategorieSolutionController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::post('categories/update-order', [CategorieSolutionController::class, 'updateOrder'])->name('categories.update-order');

    Route::resource('solutions', SolutionController::class);
    Route::patch('solutions/{solution}/toggle-status', [SolutionController::class, 'toggleStatus'])->name('solutions.toggle-status');
    Route::patch('solutions/{solution}/toggle-featured', [SolutionController::class, 'toggleFeatured'])->name('solutions.toggle-featured');
    Route::post('solutions/update-order', [SolutionController::class, 'updateOrder'])->name('solutions.update-order');


    Route::resource('projects', RealisationController::class);
    Route::patch('projects/{project}/toggle-status', [RealisationController::class, 'toggleStatus'])->name('projects.toggle-status');
    Route::patch('projects/{project}/toggle-featured', [RealisationController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::post('projects/update-order', [RealisationController::class, 'updateOrder'])->name('projects.update-order');


    Route::resource('partenaires', PartenaireController::class);
    Route::patch('partenaires/{partenaire}/toggle-status', [PartenaireController::class, 'toggleStatus'])->name('partenaires.toggle-status');
    Route::post('partenaires/update-order', [PartenaireController::class, 'updateOrder'])->name('partenaires.update-order');

    // Routes pour les témoignages
    Route::resource('temoignages', TemoignageController::class);
    Route::patch('temoignages/{temoignage}/toggle-status', [TemoignageController::class, 'toggleStatus'])->name('temoignages.toggle-status');
    Route::post('temoignages/update-order', [TemoignageController::class, 'updateOrder'])->name('temoignages.update-order');

});


Route::redirect('/public', '/');
Route::get('/public/{any}', function ($any) {
    return redirect()->to('/' . $any);
})->where('any', '.*');