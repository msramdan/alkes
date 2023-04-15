<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    NomenklaturController,
    UserController,
    ProfileController,
    RoleAndPermissionController,
    WilayahController
};
use App\Http\Controllers\frontend\AuthWebController;
use App\Http\Controllers\frontend\FaskesController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\InventarisController;
use App\Http\Controllers\frontend\LaporanLkController;
use App\Http\Controllers\frontend\MetodeKerjaController;
use App\Http\Controllers\frontend\HistoryLaporanLkController;
use App\Http\Controllers\info\InfoController;



//
// ROUTE FRONT END TEKNISI
Route::prefix('web')->middleware(['IsLoginTeknisi'])->group(function () {
    Route::get('/home', function () {
        return redirect()->route('home');
    });
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('web-profile');
    Route::get('/kontak', [HomeController::class, 'kontak'])->name('web-kontak');
    Route::post('/store_kontak', [HomeController::class, 'store_kontak'])->name('web-kontak-store');
    Route::get('/logout-web', [AuthWebController::class, 'logout'])->name('signout-user');
    Route::post('/update-password', [AuthWebController::class, 'update_password'])->name('auth-update-password');
    Route::get('/laporan_lk', [LaporanLkController::class, 'index'])->name('web-laporan_lk');
    Route::get('/create_laporan_lk', [LaporanLkController::class, 'create'])->name('web-create_laporan_lk');
    Route::post('/submit-laporan', [LaporanLkController::class, 'submitLaporan'])->name('web-submit-laporan');
    Route::get('/history_laporan', [HistoryLaporanLkController::class, 'index'])->name('web-history_laporan');
    Route::get('/history_laporan/{nolaporan}', [HistoryLaporanLkController::class, 'edit'])->name('web-history_laporan.edit');
    Route::get('/history_laporan/pendataan_administrasi/{nolaporan}', [HistoryLaporanLkController::class, 'pendataanAdministrasi'])->name('web-history_laporan.pendataanAdministrasi');
    Route::post('/history_laporan/pendataan_administrasi', [HistoryLaporanLkController::class, 'updatePendataanAdministrasi'])->name('web-history_laporan.updatePendataanAdministrasi');
    Route::get('/history_laporan/daftar_alat_ukur/{nolaporan}', [HistoryLaporanLkController::class, 'daftarAlatUkur'])->name('web-history_laporan.daftarAlatUkur');
    Route::post('/history_laporan/daftar_alat_ukur', [HistoryLaporanLkController::class, 'updateAlatUkur'])->name('web-history_laporan.updateAlatUkur');
    Route::get('/history_laporan/kondisi-lingkungan/{nolaporan}', [HistoryLaporanLkController::class, 'kondisiLingkungan'])->name('web-history_laporan.kondisiLingkungan');
    Route::post('/history_laporan/kondisi-lingkungan', [HistoryLaporanLkController::class, 'updateKondisiLingkungan'])->name('web-history_laporan.updateKondisiLingkungan');
    Route::get('/history_laporan/pemeriksaan-fisik-fungsi/{nolaporan}', [HistoryLaporanLkController::class, 'pemeriksaanFisikFungsi'])->name('web-history_laporan.pemeriksaanFisikFungsi');
    Route::post('/history_laporan/pemeriksaan-fisik-fungsi', [HistoryLaporanLkController::class, 'updatePemeriksaanFisikFungsi'])->name('web-history_laporan.updatePemeriksaanFisikFungsi');
    Route::get('/history_laporan/keselamatan-listrik/{nolaporan}', [HistoryLaporanLkController::class, 'keselamatanListrik'])->name('web-history_laporan.keselamatanListrik');
    Route::post('/history_laporan/keselamatan-listrik', [HistoryLaporanLkController::class, 'updateKeselamatanListrik'])->name('web-history_laporan.updateKeselamatanListrik');
    Route::get('/history_laporan/telaah-teknis/{nolaporan}', [HistoryLaporanLkController::class, 'telaahTeknis'])->name('web-history_laporan.telaahTeknis');
    Route::post('/history_laporan/telaah-teknis', [HistoryLaporanLkController::class, 'telaahTeknis'])->name('web-history_laporan.updateTelaahTeknis');
    Route::get('/history_laporan/kesimpulan-telaah_teknis/{nolaporan}', [HistoryLaporanLkController::class, 'kesimpulanTelaahTeknis'])->name('web-history_laporan.kesimpulanTelaahTeknis');
    Route::post('/history_laporan/kesimpulan-telaah_teknis', [HistoryLaporanLkController::class, 'updateKesimpulanTelaahTeknis'])->name('web-history_laporan.updateKesimpulanTelaahTeknis');


    Route::get('/faskes', [FaskesController::class, 'index'])->name('web-faskes');
    Route::get('/faskes/filter', [FaskesController::class, 'filter']);

    Route::get('/inventaris', [InventarisController::class, 'index'])->name('web-inventaris');
    Route::get('/inventaris/filter', [InventarisController::class, 'filter']);

    Route::get('/listmetodekerja', [MetodeKerjaController::class, 'index'])->name('web-listmetodekerja');
    Route::get('/listmetodekerja/filter', [MetodeKerjaController::class, 'filter']);
    Route::get('/listmetodekerja/download/{file}/{name}', [MetodeKerjaController::class, 'getDownload'])->name('web-listmetodekerja-download');
}); // auth teknisi
Route::get('/auth-web', [AuthWebController::class, 'index'])->name('auth-web');
Route::post('/login-web', [AuthWebController::class, 'login'])->name('auth-user');

Route::get('forget-web', [AuthWebController::class, 'forgetform'])->name('forget.password.get');
Route::post('forget-web', [AuthWebController::class, 'submitforgetform'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthWebController::class, 'ResetForm'])->name('reset.password.get');
Route::post('reset-password', [AuthWebController::class, 'submitResetForm'])->name('reset.password.post');


// =================================================================================================
// ROUTE CMS ADMIN
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'));
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});
Route::get('kota/{provinsiId}', [WilayahController::class, 'kota'])->name('api.kota');
Route::get('kecamatan/{kotaId}', [WilayahController::class, 'kecamatan'])->name('api.kecamatan');
Route::get('kelurahan/{kecamatanId}', [WilayahController::class, 'kelurahan'])->name('api.kelurahan');
Route::resource('jenis-faskes', App\Http\Controllers\JenisFaskeController::class)->middleware('auth');
Route::resource('banner-managements', App\Http\Controllers\BannerManagementController::class)->middleware('auth');
Route::resource('provinces', App\Http\Controllers\ProvinceController::class)->middleware('auth');
Route::resource('kabkots', App\Http\Controllers\KabkotController::class)->middleware('auth');
Route::resource('kecamatans', App\Http\Controllers\KecamatanController::class)->middleware('auth');
Route::resource('kelurahans', App\Http\Controllers\KelurahanController::class)->middleware('auth');
Route::resource('faskes', App\Http\Controllers\FaskeController::class)->middleware('auth');
Route::get('export-data-faskes/{jenisFaskes}/{kabkots}', [App\Http\Controllers\FaskeController::class, 'export'])->name('exportReportFaskes')->middleware('auth');
Route::resource('pelaksana-teknis', App\Http\Controllers\PelaksanaTeknisiController::class)->middleware('auth');
Route::get('export-data-teknisi', [App\Http\Controllers\PelaksanaTeknisiController::class, 'export'])->name('export-data-teknisi')->middleware('auth');
Route::resource('metode-kerjas', App\Http\Controllers\MetodeKerjaController::class)->middleware('auth');
Route::resource('kontak-masukans', App\Http\Controllers\KontakMasukanController::class)->middleware('auth');
Route::resource('rooms', App\Http\Controllers\RoomController::class)->middleware('auth');
Route::resource('brands', App\Http\Controllers\BrandController::class)->middleware('auth');
Route::resource('types', App\Http\Controllers\TypeController::class)->middleware('auth');
Route::resource('vendors', App\Http\Controllers\VendorController::class)->middleware('auth');
Route::resource('nomenklaturs', App\Http\Controllers\NomenklaturController::class)->middleware('auth');
Route::post('/nomenklatur/pemeriksaan_fisik_fungsi', [App\Http\Controllers\NomenklaturController::class, 'deletePemeriksaan'])->name('nomenklatur.pemeriksaan.delete');
Route::post('/nomenklaturs_type', [NomenklaturController::class, 'save_equipment_type'])->name('save_equipment_type');
Route::resource('inventaris', App\Http\Controllers\InventariController::class)->middleware('auth');
Route::get('export-data/{ruangan}/{merek}/{jenis_alat}/{vendor}', [App\Http\Controllers\InventariController::class, 'export'])->name('exportReportInventory')->middleware('auth');
Route::resource('laporans', App\Http\Controllers\LaporanController::class)->middleware('auth');
Route::get('export-data-lk/{start_date}/{end_date}/{teknisi}/{faskes}/{status}', [App\Http\Controllers\LaporanController::class, 'export'])->name('exportReportLk')->middleware('auth');
// =========================================================================================================
Route::get('e_sertifikat/{id}', [InfoController::class, 'sertifikat'])->name('e_sertifikat');
Route::get('info_inventaris/{id}', [InfoController::class, 'info_inventaris'])->name('info_inventaris');
