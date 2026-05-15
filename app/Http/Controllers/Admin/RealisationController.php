<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RealisationController extends Controller
{
    public function index()
    {
        $projects = Realisation::orderBy('order')->get();
        return view('administration.pages.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('administration.pages.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'featured' => 'nullable|boolean'
        ]);

        $project = new Realisation();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->category = $request->category;
        $project->order = $request->order ?? 0;
        $project->is_active = $request->has('is_active');
        $project->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Utiliser le système de stockage Laravel
            $path = $image->storeAs('realisations', $filename, 'public');
            $project->image_path = $path;
        }

        $project->save();

        return redirect()->route('administration.projects.index')
            ->with('success', 'Réalisation créée avec succès.');
    }

    public function edit(Realisation $project)
    {
        return view('administration.pages.projects.edit', compact('project'));
    }

    public function update(Request $request, Realisation $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'featured' => 'nullable|boolean'
        ]);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->category = $request->category;
        $project->order = $request->order ?? 0;
        $project->is_active = $request->has('is_active');
        $project->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Utiliser le système de stockage Laravel
            $path = $image->storeAs('realisations', $filename, 'public');
            $project->image_path = $path;
        }

        $project->save();

        return redirect()->route('administration.projects.index')
            ->with('success', 'Réalisation mise à jour avec succès.');
    }

    public function destroy(Realisation $project)
    {
        // Supprimer l'image si elle existe
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }
        
        $project->delete();
        
        return redirect()->route('administration.projects.index')
            ->with('success', 'Réalisation supprimée avec succès.');
    }

    public function toggleStatus(Realisation $project)
    {
        $project->is_active = !$project->is_active;
        $project->save();
        
        return redirect()->back()->with('success', 'Statut de la réalisation mis à jour.');
    }

    public function toggleFeatured(Realisation $project)
    {
        $project->featured = !$project->featured;
        $project->save();
        
        return redirect()->back()->with('success', 'Réalisation mise à jour.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Realisation::where('id', $id)->update(['order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}