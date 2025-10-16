<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

=======
use Illuminate\Pagination\Paginator;

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

        view()->composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                // Agar user role_id hai
                $roleId = $user->role_id;

                if ($roleId == 2) {
                    // admin (role_id 2) => show all menus
                    $menus = Menu::whereNull('parent_id')
                        ->with('children')
                        ->orderBy('order', 'asc')
                        ->get();
                } else {
                    // Other roles => show role-wise menus
                    $menus = Menu::whereNull('parent_id')
                        ->whereHas('roles', fn($q) => $q->where('role_id', $roleId))
                        ->with(['children' => fn($q) => $q->whereHas('roles', fn($qr) => $qr->where('role_id', $roleId))])
                        ->orderBy('order', 'asc')
                        ->get();
                }
            } else {
                // Not logged in
                $menus = collect();
            }

            $view->with('menus', $menus);
        });

        Paginator::useBootstrap();

    }
}
