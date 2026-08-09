<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\HeroStat;
use App\Models\BoostMe;
use App\Models\Service;
use App\Models\Resource;
use App\Models\About;
use App\Models\News;

class SiteController extends Controller
{
    public function inicio()
    {
        $hero = HeroSection::first();
        $stats = HeroStat::orderBy('sort_order')->orderBy('id')->get();
        $boost = BoostMe::where('is_active', true)->first();
        $services = Service::orderBy('is_featured', 'desc')->orderBy('id')->get();
        $resources = Resource::all();
        $about = About::first();
        $news = News::orderBy('published_at', 'desc')->take(3)->get();

        return view('site.inicio', compact('hero', 'stats', 'boost', 'services', 'resources', 'about', 'news'));
    }

    public function servicos()
    {
        $services = Service::orderBy('is_featured', 'desc')->orderBy('id')->get();

        return view('site.servicos', compact('services'));
    }

    public function recursos()
    {
        $resources = Resource::all();

        return view('site.recursos', compact('resources'));
    }

    public function sobre()
    {
        $about = About::first();

        return view('site.sobre', compact('about'));
    }

    public function noticias()
    {
        $news = News::orderBy('published_at', 'desc')->get();

        return view('site.noticias', compact('news'));
    }
}
