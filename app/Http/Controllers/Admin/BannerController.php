<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('administration.pages.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('administration.pages.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->description = $request->description;
        $banner->button_text = $request->button_text ?? 'Our Services';
        $banner->button_link = $request->button_link ?? 'services.html';
        $banner->order = $request->order ?? 0;
        $banner->is_active = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $filename = time() . '_' . Str::slug($request->title ?? 'banner') . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/banners');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $filename);
            $banner->background_image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('administration.banners.index')
            ->with('success', 'Banner créé avec succès.');
    }

    public function edit(Banner $banner)
    {
        return view('administration.pages.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->description = $request->description;
        $banner->button_text = $request->button_text ?? 'Our Services';
        $banner->button_link = $request->button_link ?? 'services.html';
        $banner->order = $request->order ?? 0;
        $banner->is_active = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            // Supprimer l'ancienne image
            if ($banner->background_image && file_exists(public_path($banner->background_image))) {
                unlink(public_path($banner->background_image));
            }
            
            $image = $request->file('background_image');
            $filename = time() . '_' . Str::slug($request->title ?? 'banner') . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/banners');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $filename);
            $banner->background_image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('administration.banners.index')
            ->with('success', 'Banner mis à jour avec succès.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->background_image && file_exists(public_path($banner->background_image))) {
            unlink(public_path($banner->background_image));
        }
        
        $banner->delete();
        
        return redirect()->route('administration.banners.index')
            ->with('success', 'Banner supprimé avec succès.');
    }
}