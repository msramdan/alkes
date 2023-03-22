<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['users.create', 'users.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });
  

				View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'rooms',
                \App\Models\Room::select('id', 'nama_ruangan')->get()
            );
        });

		View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'types',
                \App\Models\Type::select('id', 'jenis_alat')->get()
            );
        });

		View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'brands',
                \App\Models\Brand::select('id', 'nama_merek')->get()
            );
        });

		View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'vendors',
                \App\Models\Vendor::select('id', 'nama_vendor')->get()
            );
        });

	}
}