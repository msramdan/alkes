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

		View::composer(['faskes.create', 'faskes.edit'], function ($view) {
            return $view->with(
                'kabkots',
                \App\Models\Kabkot::select('id', 'provinsi_id')->get()
            );
        });

		View::composer(['faskes.create', 'faskes.edit'], function ($view) {
            return $view->with(
                'kecamatans',
                \App\Models\Kecamatan::select('id', 'kabkot_id')->get()
            );
        });

		View::composer(['faskes.create', 'faskes.edit'], function ($view) {
            return $view->with(
                'kelurahans',
                \App\Models\Kelurahan::select('id', 'kecamatan_id')->get()
            );
        });

		View::composer(['kontak-masukans.create', 'kontak-masukans.edit'], function ($view) {
            return $view->with(
                'pelaksanaTeknis',
                \App\Models\PelaksanaTekni::select('id')->get()
            );
        });

	}
}