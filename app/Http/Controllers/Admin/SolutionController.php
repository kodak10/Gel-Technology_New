<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\CategorieSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::with('categorie')->orderBy('order')->get();
        return view('administration.pages.solutions.index', compact('solutions'));
    }

    public function create()
    {
        $categories = CategorieSolution::where('is_active', true)->orderBy('order')->get();
        return view('administration.pages.solutions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_solution_id' => 'required|exists:categorie_solutions,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:solutions,slug',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $solution = new Solution();
        $solution->categorie_solution_id = $request->categorie_solution_id;
        $solution->title = $request->title;
        $solution->slug = $request->slug ?? \Illuminate\Support\Str::slug($request->title);
        $solution->short_description = $request->short_description;
        $solution->full_description = $request->full_description;
        $solution->color = $request->color ?? '#3b82f6';
        $solution->link = $request->link;
        $solution->button_text = $request->button_text ?? 'Découvrir';
        $solution->order = $request->order ?? 0;
        $solution->is_active = $request->has('is_active');
        $solution->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('solutions', $filename, 'public');
            $solution->image_path = $path;
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = time() . '_icon_' . $icon->getClientOriginalName();
            $path = $icon->storeAs('solutions/icons', $filename, 'public');
            $solution->icon = $path;
        }

        $solution->save();

        return redirect()->route('administration.solutions.index')->with('success', 'Solution créée avec succès.');
    }

    public function edit(Solution $solution)
    {
        $categories = CategorieSolution::where('is_active', true)->orderBy('order')->get();
        return view('administration.pages.solutions.edit', compact('solution', 'categories'));
    }

    public function update(Request $request, Solution $solution)
    {
        $request->validate([
            'categorie_solution_id' => 'required|exists:categorie_solutions,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:solutions,slug,' . $solution->id,
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $solution->categorie_solution_id = $request->categorie_solution_id;
        $solution->title = $request->title;
        $solution->slug = $request->slug ?? \Illuminate\Support\Str::slug($request->title);
        $solution->short_description = $request->short_description;
        $solution->full_description = $request->full_description;
        $solution->color = $request->color ?? '#3b82f6';
        $solution->link = $request->link;
        $solution->button_text = $request->button_text ?? 'Découvrir';
        $solution->order = $request->order ?? 0;
        $solution->is_active = $request->has('is_active');
        $solution->featured = $request->has('featured');

        if ($request->hasFile('image')) {
            if ($solution->image_path) {
                Storage::disk('public')->delete($solution->image_path);
            }
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('solutions', $filename, 'public');
            $solution->image_path = $path;
        }

        if ($request->hasFile('icon')) {
            if ($solution->icon) {
                Storage::disk('public')->delete($solution->icon);
            }
            $icon = $request->file('icon');
            $filename = time() . '_icon_' . $icon->getClientOriginalName();
            $path = $icon->storeAs('solutions/icons', $filename, 'public');
            $solution->icon = $path;
        }

        $solution->save();

        return redirect()->route('administration.solutions.index')->with('success', 'Solution mise à jour avec succès.');
    }

    public function destroy(Solution $solution)
    {
        if ($solution->image_path) {
            Storage::disk('public')->delete($solution->image_path);
        }
        if ($solution->icon) {
            Storage::disk('public')->delete($solution->icon);
        }
        
        $solution->delete();
        
        return redirect()->route('administration.solutions.index')->with('success', 'Solution supprimée avec succès.');
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