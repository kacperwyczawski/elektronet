<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        Model::unguard();
        FilamentColor::register(fn () => [
            'primary' => Auth::user()?->name == 'elzcze' ? '#5992ca' : '#d4293d',
            'danger' => '#d4293d',
        ]);
    }
}
