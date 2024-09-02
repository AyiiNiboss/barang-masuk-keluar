<?php

namespace App\Providers;

use App\Models\User;
use App\Models\permintaanModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $notif_permintaan = permintaanModel::select('user_id','tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
            ->groupBy('user_id', 'tgl_permintaan')
            ->where('status', 1)
            ->get()
            ->count();
            $notif_user = User::where('status', 'tidak')->count();
            $all_notif = $notif_permintaan + $notif_user;
            $view->with([
                'notif_permintaan' => $notif_permintaan,
                'notif_user' => $notif_user,
                'all_notif' => $all_notif
            ]);
        });
    }
}
