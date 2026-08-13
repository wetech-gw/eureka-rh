<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\HeroStat;
use App\Models\BoostMe;
use App\Models\Service;
use App\Models\Resource;
use App\Models\About;
use App\Models\News;
use App\Models\ContactInfo;

class SiteController extends Controller
{
    private function contactos()
    {
        return ContactInfo::first();
    }

    public function inicio()
    {
        $hero = HeroSection::first();
        $stats = HeroStat::orderBy('sort_order')->orderBy('id')->get();
        $boost = BoostMe::where('is_active', true)->first();
        $services = Service::orderBy('is_featured', 'desc')->orderBy('id')->get();
        $resources = Resource::all();
        $about = About::first();
        $news = News::orderBy('published_at', 'desc')->take(3)->get();
        $contact = $this->contactos();

        return view('site.inicio', compact('hero', 'stats', 'boost', 'services', 'resources', 'about', 'news', 'contact'));
    }

    public function servicos()
    {
        $services = Service::orderBy('is_featured', 'desc')->orderBy('id')->get();
        $contact = $this->contactos();

        return view('site.servicos', compact('services', 'contact'));
    }

    public function recursos()
    {
        $resources = Resource::all();
        $contact = $this->contactos();

        return view('site.recursos', compact('resources', 'contact'));
    }

    public function sobre()
    {
        $about = About::first();
        $contact = $this->contactos();

        return view('site.sobre', compact('about', 'contact'));
    }

    public function noticias()
    {
        $news = News::orderBy('published_at', 'desc')->get();
        $contact = $this->contactos();

        return view('site.noticias', compact('news', 'contact'));
    }
}
