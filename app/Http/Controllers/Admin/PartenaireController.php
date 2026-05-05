<?php
// app/Http/Controllers/Admin/PartenaireController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'order' => 'nullable|integer'
        ]);

        $partenaire = new Partenaire();
        $partenaire->name = $request->name;
        $partenaire->link = $request->link;
        $partenaire->order = $request->order ?? 0;
        $partenaire->is_active = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('partenaires', $filename, 'public');
            $partenaire->logo_path = $path;
        }

        $partenaire->save();

        return redirect()->route('administration.partenaires.index')->with('success', 'Partenaire ajouté avec succès.');
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
            'order' => 'nullable|integer'
        ]);

        $partenaire->name = $request->name;
        $partenaire->link = $request->link;
        $partenaire->order = $request->order ?? 0;
        $partenaire->is_active = $request->has('is_active');

        if ($request->hasFile('logo')) {
            if ($partenaire->logo_path) {
                Storage::disk('public')->delete($partenaire->logo_path);
            }
            $logo = $request->file('logo');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('partenaires', $filename, 'public');
            $partenaire->logo_path = $path;
        }

        $partenaire->save();

        return redirect()->route('administration.partenaires.index')->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partenaire $partenaire)
    {
        if ($partenaire->logo_path) {
            Storage::disk('public')->delete($partenaire->logo_path);
        }
        $partenaire->delete();
        return redirect()->route('administration.partenaires.index')->with('success', 'Partenaire supprimé avec succès.');
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