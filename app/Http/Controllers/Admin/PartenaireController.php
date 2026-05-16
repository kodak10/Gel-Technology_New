<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy('order')->get();
        return view('administration.pages.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        return view('administration.pages.partenaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $partenaire = new Partenaire();
        $partenaire->name = $request->name;
        $partenaire->link = $request->link;
        $partenaire->order = $request->order ?? 0;
        $partenaire->is_active = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            
            // Stocker directement dans public/uploads/partenaires
            $destinationPath = public_path('uploads/partenaires');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $logo->move($destinationPath, $filename);
            $partenaire->logo_path = 'uploads/partenaires/' . $filename;
        }

        $partenaire->save();

        return redirect()->route('administration.partenaires.index')
            ->with('success', 'Partenaire ajouté avec succès.');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('administration.pages.partenaires.edit', compact('partenaire'));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $partenaire->name = $request->name;
        $partenaire->link = $request->link;
        $partenaire->order = $request->order ?? 0;
        $partenaire->is_active = $request->has('is_active');

        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo
            if ($partenaire->logo_path && file_exists(public_path($partenaire->logo_path))) {
                unlink(public_path($partenaire->logo_path));
            }

            $logo = $request->file('logo');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/partenaires');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $logo->move($destinationPath, $filename);
            $partenaire->logo_path = 'uploads/partenaires/' . $filename;
        }

        $partenaire->save();

        return redirect()->route('administration.partenaires.index')
            ->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partenaire $partenaire)
    {
        // Supprimer le logo
        if ($partenaire->logo_path && file_exists(public_path($partenaire->logo_path))) {
            unlink(public_path($partenaire->logo_path));
        }
        
        $partenaire->delete();
        
        return redirect()->route('administration.partenaires.index')
            ->with('success', 'Partenaire supprimé avec succès.');
    }

    public function toggleStatus(Partenaire $partenaire)
    {
        $partenaire->is_active = !$partenaire->is_active;
        $partenaire->save();
        
        return redirect()->back()->with('success', 'Statut du partenaire mis à jour.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Partenaire::where('id', $id)->update(['order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}