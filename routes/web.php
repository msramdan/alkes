<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    NomenklaturController,
    UserController,
    ProfileController,
    RoleAndPermissionController
};
use App\Http\Controllers\frontend\AuthWebController;
use App\Http\Controllers\frontend\HomeController;

// ROUTE FRONT END TEKNISI
Route::prefix('web')->group(function () {
    Route::get('/home', function () {
        return redirect()->route('home');
    });
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('web-profile');
    Route::get('/kontak', [HomeController::class, 'kontak'])->name('web-kontak');
    Route::get('/auth-web', [AuthWebController::class, 'index'])->name('auth-web');
    Route::post('/login-web', [AuthWebController::class, 'login'])->name('auth-user');;
    Route::get('/logout-web', [AuthWebController::class, 'logout'])->name('signout-user');
});

// =================================================================================================
// ROUTE CMS ADMIN
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'));
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});
Route::middleware(['auth', 'permission:test view'])->get('/tests', function () {
    dd('This is just a test and an example for permission and sidebar menu. You can remove this line on web.php, config/permission.php and config/generator.php');
})->name('tests.index');
Route::resource('jenis-faskes', App\Http\Controllers\JenisFaskeController::class)->middleware('auth');
Route::resource('banner-managements', App\Http\Controllers\BannerManagementController::class)->middleware('auth');
Route::resource('provinces', App\Http\Controllers\ProvinceController::class)->middleware('auth');
Route::resource('kabkots', App\Http\Controllers\KabkotController::class)->middleware('auth');
Route::resource('kecamatans', App\Http\Controllers\KecamatanController::class)->middleware('auth');
Route::resource('kelurahans', App\Http\Controllers\KelurahanController::class)->middleware('auth');
Route::resource('faskes', App\Http\Controllers\FaskeController::class)->middleware('auth');
Route::resource('pelaksana-teknis', App\Http\Controllers\PelaksanaTeknisiController::class)->middleware('auth');

Route::resource('metode-kerjas', App\Http\Controllers\MetodeKerjaController::class)->middleware('auth');
Route::resource('kontak-masukans', App\Http\Controllers\KontakMasukanController::class)->middleware('auth');
Route::resource('rooms', App\Http\Controllers\RoomController::class)->middleware('auth');
Route::resource('brands', App\Http\Controllers\BrandController::class)->middleware('auth');
Route::resource('types', App\Http\Controllers\TypeController::class)->middleware('auth');
Route::resource('vendors', App\Http\Controllers\VendorController::class)->middleware('auth');
Route::resource('nomenklaturs', App\Http\Controllers\NomenklaturController::class)->middleware('auth');
Route::post('/nomenklaturs_type', [NomenklaturController::class, 'save_equipment_type'])->name('save_equipment_type');
Route::resource('inventaris', App\Http\Controllers\InventariController::class)->middleware('auth');
