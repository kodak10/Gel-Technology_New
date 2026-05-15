<?php
// app/Http/Controllers/Admin/SolutionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\CategorieSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::orderBy('order')->get();
        return view('administration.pages.solutions.index', compact('solutions'));
    }

    public function create()
    {
        $categories = CategorieSolution::orderBy('name')->get();
        return view('administration.pages.solutions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_solution_id' => 'nullable|exists:categorie_solutions,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:50',
            'slug' => 'nullable|string|unique:solutions,slug',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'featured' => 'nullable|boolean'
        ]);

        $solution = new Solution();
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->categorie_solution_id = $request->categorie_solution_id;
        $solution->button_text = $request->button_text ?? 'Voir plus';
        $solution->slug = $request->slug ?? Str::slug($request->title);
        $solution->order = $request->order ?? 0;
        $solution->is_active = $request->has('is_active');
        $solution->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Stocker directement dans public/uploads/solutions
            $destinationPath = public_path('uploads/solutions');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $filename);
            $solution->image_path = 'uploads/solutions/' . $filename;
        }

        $solution->save();

        return redirect()->route('administration.solutions.index')
            ->with('success', 'Solution créée avec succès.');
    }

    public function edit(Solution $solution)
    {
        $categories = CategorieSolution::orderBy('name')->get();
        return view('administration.pages.solutions.edit', compact('solution', 'categories'));
    }

    public function update(Request $request, Solution $solution)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_solution_id' => 'nullable|exists:categorie_solutions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:50',
            'slug' => 'nullable|string|unique:solutions,slug,' . $solution->id,
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'featured' => 'nullable|boolean'
        ]);

        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->categorie_solution_id = $request->categorie_solution_id;
        $solution->button_text = $request->button_text ?? 'Voir plus';
        $solution->slug = $request->slug ?? Str::slug($request->title);
        $solution->order = $request->order ?? 0;
        $solution->is_active = $request->has('is_active');
        $solution->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($solution->image_path && file_exists(public_path($solution->image_path))) {
                unlink(public_path($solution->image_path));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/solutions');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $filename);
            $solution->image_path = 'uploads/solutions/' . $filename;
        }

        $solution->save();

        return redirect()->route('administration.solutions.index')
            ->with('success', 'Solution mise à jour avec succès.');
    }

    public function destroy(Solution $solution)
    {
        if ($solution->image_path && file_exists(public_path($solution->image_path))) {
            unlink(public_path($solution->image_path));
        }
        
        $solution->delete();
        
        return redirect()->route('administration.solutions.index')
            ->with('success', 'Solution supprimée avec succès.');
    }

    public function toggleStatus(Solution $solution)
    {
        $solution->is_active = !$solution->is_active;
        $solution->save();
        
        return redirect()->back()->with('success', 'Statut de la solution mis à jour.');
    }

    public function toggleFeatured(Solution $solution)
    {
        $solution->featured = !$solution->featured;
        $solution->save();
        
        return redirect()->back()->with('success', 'Solution mise à jour.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Solution::where('id', $id)->update(['order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}