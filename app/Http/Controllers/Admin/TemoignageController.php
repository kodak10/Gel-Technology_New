<?php
// app/Http/Controllers/Admin/TemoignageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::orderBy('order')->get();
        return view('administration.pages.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('administration.pages.temoignages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'social_links' => 'nullable|array',
            'border_color' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $temoignage = new Temoignage();
        $temoignage->name = $request->name;
        $temoignage->position = $request->position;
        $temoignage->message = $request->message;
        $temoignage->rating = $request->rating ?? 5;
        $temoignage->border_color = $request->border_color ?? 'primary';
        $temoignage->order = $request->order ?? 0;
        $temoignage->is_active = $request->has('is_active');
        $temoignage->social_links = $request->social_links;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $avatar->getClientOriginalExtension();
            
            // Stocker directement dans public/uploads/temoignages
            $destinationPath = public_path('uploads/temoignages');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $avatar->move($destinationPath, $filename);
            $temoignage->avatar_path = 'uploads/temoignages/' . $filename;
        }

        $temoignage->save();

        return redirect()->route('administration.temoignages.index')
            ->with('success', 'Témoignage ajouté avec succès.');
    }

    public function edit(Temoignage $temoignage)
    {
        return view('administration.pages.temoignages.edit', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'social_links' => 'nullable|array',
            'border_color' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $temoignage->name = $request->name;
        $temoignage->position = $request->position;
        $temoignage->message = $request->message;
        $temoignage->rating = $request->rating ?? 5;
        $temoignage->border_color = $request->border_color ?? 'primary';
        $temoignage->order = $request->order ?? 0;
        $temoignage->is_active = $request->has('is_active');
        $temoignage->social_links = $request->social_links;

        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar
            if ($temoignage->avatar_path && file_exists(public_path($temoignage->avatar_path))) {
                unlink(public_path($temoignage->avatar_path));
            }

            $avatar = $request->file('avatar');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $avatar->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/temoignages');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $avatar->move($destinationPath, $filename);
            $temoignage->avatar_path = 'uploads/temoignages/' . $filename;
        }

        $temoignage->save();

        return redirect()->route('administration.temoignages.index')
            ->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(Temoignage $temoignage)
    {
        if ($temoignage->avatar_path && file_exists(public_path($temoignage->avatar_path))) {
            unlink(public_path($temoignage->avatar_path));
        }
        
        $temoignage->delete();
        
        return redirect()->route('administration.temoignages.index')
            ->with('success', 'Témoignage supprimé avec succès.');
    }

    public function toggleStatus(Temoignage $temoignage)
    {
        $temoignage->is_active = !$temoignage->is_active;
        $temoignage->save();
        
        return redirect()->back()->with('success', 'Statut du témoignage mis à jour.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Temoignage::where('id', $id)->update(['order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}