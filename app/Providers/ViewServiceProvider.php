<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewServiceProvider extends ServiceProvider
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


        View::composer(['kabkots.create', 'kabkots.edit'], function ($view) {
            return $view->with(
                'provinces',
                \App\Models\Province::select('id', 'provinsi')->get()
            );
        });

        View::composer(['kecamatans.create', 'kecamatans.edit'], function ($view) {
            return $view->with(
                'kabkots',
                \App\Models\Kabkot::select('id', 'kabupaten_kota')->get()
            );
        });

        View::composer(['kelurahans.create', 'kelurahans.edit'], function ($view) {
            return $view->with(
                'kecamatans',
                \App\Models\Kecamatan::select('id', 'kecamatan')->get()
            );
        });


        View::composer(['faskes.create', 'faskes.edit'], function ($view) {
            return $view->with(
                'jenisFaskes',
                \App\Models\JenisFaske::select('id', 'nama_jenis_faskes')->get()
            );
        });

        View::composer(['faskes.create', 'faskes.edit'], function ($view) {
            return $view->with(
                'provinces',
                \App\Models\Province::select('id', 'provinsi')->get()
            );
        });

        View::composer(['kontak-masukans.create', 'kontak-masukans.edit'], function ($view) {
            return $view->with(
                'pelaksanaTeknis',
                \App\Models\PelaksanaTeknisi::select('id')->get()
            );
        });

        View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'rooms',
                \App\Models\Room::select('id', 'nama_ruangan')->get()
            );
        });

        View::composer(['inventaris.create'], function ($view) {
            return $view->with(
                'types',
                \App\Models\Type::select('id', 'jenis_alat')->get()
            );
        });

        View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'vendors',
                \App\Models\Vendor::select('id', 'nama_vendor')->get()
            );
        });

        View::composer(['inventaris.create', 'inventaris.edit'], function ($view) {
            return $view->with(
                'brands',
                \App\Models\Brand::select('id', 'nama_merek')->get()
            );
        });
    }
}
