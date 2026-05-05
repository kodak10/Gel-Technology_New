<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CategorieSolution;
use App\Models\Solution;
use App\Models\Realisation;
use App\Models\Partenaire;
use App\Models\Temoignage;

class WebsiteController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $solutions = Solution::where('is_active', true)
                            ->with('categorie')
                            ->orderBy('order')
                            ->take(8) // Limiter à 8 solutions si besoin
                            ->get();
        
        $projects = Realisation::where('is_active', true)
                              ->orderBy('order')
                              ->get();
        $partenaires = Partenaire::where('is_active', true)->orderBy('order')->get();
        $temoignages = Temoignage::where('is_active', true)->orderBy('order')->get();
        
        return view('index', compact('banners', 'solutions', 'projects', 'partenaires', 'temoignages'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        // Récupérer toutes les solutions actives avec pagination
        $solutions = Solution::where('is_active', true)
                            ->with('categorie')
                            ->orderBy('order')
                            ->paginate(12);
        
        // Récupérer les catégories pour le filtre
        $categories = CategorieSolution::where('is_active', true)
                                       ->withCount('solutions')
                                       ->orderBy('order')
                                       ->get();
        
        // Récupérer les témoignages
        $temoignages = Temoignage::where('is_active', true)
                                 ->orderBy('order')
                                 ->get();
        
        // Récupérer les partenaires
        $partenaires = Partenaire::where('is_active', true)
                                 ->orderBy('order')
                                 ->get();
        
        return view('services', compact('solutions', 'categories', 'temoignages', 'partenaires'));
    }

    public function serviceDetails($slug)
    {
        // Récupérer le service par son slug
        $service = Solution::where('slug', $slug)
                          ->where('is_active', true)
                          ->with('categorie')
                          ->firstOrFail();
        
        // Récupérer les autres services de la même catégorie
        $sameCategoryServices = Solution::where('categorie_solution_id', $service->categorie_solution_id)
                                        ->where('id', '!=', $service->id)
                                        ->where('is_active', true)
                                        ->orderBy('order')
                                        ->take(5)
                                        ->get();
        
        // Récupérer toutes les catégories pour la sidebar
        $categories = CategorieSolution::where('is_active', true)
                                       ->withCount('solutions')
                                       ->orderBy('order')
                                       ->get();
        
        // Récupérer les réalisations pour la section "Nos Réalisations"
        $projects = Realisation::where('is_active', true)
                              ->orderBy('order')
                              ->take(6)
                              ->get();
        
        return view('service-detail', compact('service', 'sameCategoryServices', 'categories', 'projects'));
    }

public function contact()
{
    $partenaires = Partenaire::where('is_active', true)->orderBy('order')->get();
    $temoignages = Temoignage::where('is_active', true)->orderBy('order')->get();
    
    return view('contact', compact('partenaires', 'temoignages'));
}

    public function realisations()
    {
        $projects = Realisation::where('is_active', true)
                            ->orderBy('order')
                            ->paginate(9);
        
        $categories = Realisation::select('category')
                                ->where('is_active', true)
                                ->whereNotNull('category')
                                ->distinct()
                                ->get();
        
        $partenaires = Partenaire::where('is_active', true)->orderBy('order')->get();
        $temoignages = Temoignage::where('is_active', true)->orderBy('order')->get();
        
        return view('realisations', compact('projects', 'categories', 'partenaires', 'temoignages'));
    }

    public function realisationDetails($id)
    {
        $project = Realisation::where('id', $id)
                            ->where('is_active', true)
                            ->firstOrFail();
        
        return view('realisation-details', compact('project'));
    }

}
