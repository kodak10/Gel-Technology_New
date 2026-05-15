<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorieSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieSolutionController extends Controller
{
    public function index()
    {
        $categories = CategorieSolution::orderBy('order')->get();
        return view('administration.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('administration.pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categorie_solutions,slug',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $category = new CategorieSolution();
        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->order = $request->order ?? 0;
        $category->is_active = $request->has('is_active');

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $icon->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/categories');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $icon->move($destinationPath, $filename);
            $category->icon = 'uploads/categories/' . $filename;
        }

        $category->save();

        return redirect()->route('administration.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(CategorieSolution $category)
    {
        return view('administration.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, CategorieSolution $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categorie_solutions,slug,' . $category->id,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->order = $request->order ?? 0;
        $category->is_active = $request->has('is_active');

        if ($request->hasFile('icon')) {
            // Supprimer l'ancienne icône
            if ($category->icon && file_exists(public_path($category->icon))) {
                unlink(public_path($category->icon));
            }
            
            $icon = $request->file('icon');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $icon->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/categories');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $icon->move($destinationPath, $filename);
            $category->icon = 'uploads/categories/' . $filename;
        }

        $category->save();

        return redirect()->route('administration.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(CategorieSolution $category)
    {
        if ($category->icon && file_exists(public_path($category->icon))) {
            unlink(public_path($category->icon));
        }
        
        $category->delete();
        
        return redirect()->route('administration.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    public function toggleStatus(CategorieSolution $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();
        
        return redirect()->back()->with('success', 'Statut de la catégorie mis à jour.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            CategorieSolution::where('id', $id)->update(['order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}