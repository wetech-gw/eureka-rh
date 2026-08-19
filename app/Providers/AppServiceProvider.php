<?php

namespace App\Providers;

use App\Models\ActivityLog;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['partials.sidebar', 'dashboard'], function ($view) {
            $view->with('mensagensNaoLidas', ContactMessage::naoLidas()->count());
            $view->with('atividadesNaoVistas', ActivityLog::naoVistas()->where('user_id', Auth::id())->count());
        });
    }
}
