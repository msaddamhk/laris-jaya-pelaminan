<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GaleriController;
use App\Http\Controllers\admin\JasaController;
use App\Http\Controllers\admin\JasaOpsiController;
use App\Http\Controllers\admin\JasaOpsiItemController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\KategoriGaleriController;
use App\Http\Controllers\admin\KelolaAdminController;
use App\Http\Controllers\admin\KelolaGambarController;
use App\Http\Controllers\admin\KelolaPesananController;
use App\Http\Controllers\admin\RekeningBankController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\user\BerandaController;
use App\Http\Controllers\user\DetailJasaController;
use App\Http\Controllers\user\GaleriController as UserGaleriController;
use App\Http\Controllers\user\JasaController as UserJasaController;
use App\Http\Controllers\user\UpdateUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['verify' => true]);

Route::get('/google', [GoogleController::class, 'index'])->name('google.index');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/', [BerandaController::class, 'index'])->name('home');

Route::get('/seluruh-jasa', [UserJasaController::class, 'index'])->name('home.jasa');

Route::get('/galeri', [UserGaleriController::class, 'index'])->name('home.galeri');

Route::get('/detail-jasa/{jasa}', [DetailJasaController::class, 'index'])->name('detail');

Route::get('/beli-sekarang', [OrderController::class, 'index'])->name('order.index')->middleware(['auth', 'verified']);

Route::post('/beli-sekarang/store-pesanan', [OrderController::class, 'store'])->name('order.store');

Route::middleware('auth')->group(function () {

    Route::get('/update-profil/{user}', [UpdateUserController::class, 'index'])->name('home.update.profile');

    Route::put('/update-profil/{user}/store', [UpdateUserController::class, 'update'])->name('home.update.profile.update');

    Route::get('/pesanann', [OrderController::class, 'terpesan'])->name('terpesan');

    Route::get('/pesanan/{pemesanan}/edit', [OrderController::class, 'edit'])->name('edit.pesanan');

    Route::get('/pesanan/{pemesanan}/download-invoice', [OrderController::class, 'pdf'])->name('invoice');

    Route::post('/pesanan/{pemesanan}/update', [OrderController::class, 'update'])->name('update.pesanan');

    Route::middleware('can:isAdmin')->group(function () {

        Route::resource('kategori', KategoriController::class);

        Route::resource('galeri-kategori', KategoriGaleriController::class);

        Route::resource('kelola-galeri', GaleriController::class);

        Route::resource('slider', SliderController::class);

        Route::resource('vendor', VendorController::class);

        Route::resource('jasa', JasaController::class);

        Route::resource('rekening', RekeningBankController::class);

        Route::resource('data-admin', KelolaAdminController::class);

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::get('/jasa/{jasa}/gambar', [KelolaGambarController::class, 'index'])
            ->name('gambar.index');

        Route::get('/jasa/{jasa}/gambar/tambah', [KelolaGambarController::class, 'create'])
            ->name('gambar.create');

        Route::post('/jasa/{jasa}/gambar/tambah/store', [KelolaGambarController::class, 'store'])
            ->name('gambar.store');

        Route::get('/jasa/{jasa}/gambar/{jasafoto}/edit', [KelolaGambarController::class, 'edit'])
            ->name('gambar.edit');

        Route::post('/jasa/{jasa}/gambar/{jasafoto}/edit/update', [KelolaGambarController::class, 'update'])
            ->name('gambar.update');

        Route::delete('/jasa/{jasa}/gambar/{jasafoto}/hapus', [KelolaGambarController::class, 'destroy'])
            ->name('gambar.destroy');

        Route::get('/jasa/{jasa}/opsi', [JasaOpsiController::class, 'index'])
            ->name('opsi.index');

        Route::get('/jasa/{jasa}/opsi/tambah', [JasaOpsiController::class, 'create'])
            ->name('opsi.create');

        Route::post('/jasa/{jasa}/opsi/tambah/store', [JasaOpsiController::class, 'store'])
            ->name('opsi.store');

        Route::get('/jasa/{jasa}/opsi/{jasaopsi}/edit', [JasaOpsiController::class, 'edit'])
            ->name('opsi.edit');

        Route::post('/jasa/{jasa}/opsi/{jasaopsi}/edit/update', [JasaOpsiController::class, 'update'])
            ->name('opsi.update');

        Route::delete('/jasa/{jasa}/opsi/{jasaopsi}/hapus', [JasaOpsiController::class, 'destroy'])
            ->name('opsi.destroy');

        Route::get('/jasa/{jasa}/opsi/{jasaopsi}', [JasaOpsiItemController::class, 'index'])
            ->name('opsi.item.index');

        Route::get('/jasa/{jasa}/opsi/{jasaopsi}/tambah', [JasaOpsiItemController::class, 'create'])
            ->name('opsi.item.create');

        Route::post('/jasa/{jasa}/opsi/{jasaopsi}/tambah/store', [JasaOpsiItemController::class, 'store'])
            ->name('opsi.item.store');

        Route::get('/jasa/{jasa}/opsi/{jasaopsi}/edit/{jasaopsiitem}', [JasaOpsiItemController::class, 'edit'])
            ->name('opsi.item.edit');

        Route::post('/jasa/{jasa}/opsi/{jasaopsi}/edit/{jasaopsiitem}/update', [JasaOpsiItemController::class, 'update'])
            ->name('opsi.item.update');

        Route::delete('/jasa/{jasa}/opsi/{jasaopsi}/{jasaopsiitem}/hapus', [JasaOpsiItemController::class, 'destroy'])
            ->name('opsi.item.destroy');

        Route::get('/kelola-pemesanan', [KelolaPesananController::class, 'index'])
            ->name('pemesanan.index');

        Route::get('/kelola-pemesanan/{pemesanan}/edit', [KelolaPesananController::class, 'edit'])
            ->name('pemesanan.edit');

        Route::put('/kelola-pemesanan/{pemesanan}/edit/update', [KelolaPesananController::class, 'update'])
            ->name('pemesanan.update');

        Route::get('/edit_pemesanan_item/{pemesanan_item}', [KelolaPesananController::class, 'pemesanan_item_edit'])
            ->name('pemesanan_item.edit');

        Route::put('/edit_pemesanan_item/{pemesanan_item}/update', [KelolaPesananController::class, 'pemesanan_item_update'])
            ->name('pemesanan_item.update');
    });
});
