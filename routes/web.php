<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/logon',function(){
    return view('admin/login/login');
})->name('admin.login');
Route::post('/admin/action/login',[AdminController::class,'action_login']);
Route::prefix('admin')->middleware('auth.admin')->group(function(){
    Route::get('/dashboard',[AdminController::class,'panel_index'])->name('admin.dashboard');
    Route::get('/menu/{table}/tambah',[AdminController::class,'menu_tambah']);
    Route::post('/menu/{table}/tambah',[AdminController::class,'tambah_data']);
    Route::get('/menu/{table}/edit/{id}',[AdminController::class,'menu_edit']);
    Route::post('/menu/{table}/proses_hapus/{id}',[AdminController::class,'hapus_data']);
    Route::get('/menu/{page}/detail/{id}',[AdminController::class,'detail']);
    Route::put('/menu/{data_menu}/proses_edit/{id}',[AdminController::class,'edit_data']);
    Route::get('/menu/{page}',[AdminController::class,'menu_index']);
    Route::post('/logout',[AdminController::class,'logout']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
});

Route::get('/',[HomeController::class,'dashboard']);
//  Route::get('/',function(){
//     return view('home/maintenance');
//  });

Route::get('/detail_home/{id}',[HomeController::class,'detail_item']);
Route::get('/daftar/{kategori}',[HomeController::class,'filter_kategori']);
Route::get('/daftar/jarang',[HomeController::class,'jarang_dilihat']);
Route::get('/daftar/belum',[HomeController::class,'belum_dilihat']);
Route::get('/home/about',[HomeController::class,'about_company']);
Route::post('/home/find_kontrakan',[HomeController::class,'find_kontrakan']);
Route::get('/home/about#contact',[HomeController::class,'about_company#contact']);
Route::get('/home/validate-captcha-wa',[HomeController::class,'captcha']);
//Route for Owner

// Route::get('/owner',[OwnerController::class,'owner_ddashboard']);
Route::get('/owner/login_page',function(){
    return view('owner/login');
})->name('owner.login');
Route::post('/login/owner/request',[OwnerController::class,'action_login']);

Route::middleware('auth.owner')->group(function(){
Route::get('/owner',[OwnerController::class,'owner_dashboard'])->name('owner.index');
Route::post('/action/update/j_kamar',[OwnerController::class,'set_jum_kamar']);
Route::get('/owner/update_harga',[OwnerController::class,'page_harga']);

Route::get('/update_kamar',[OwnerController::class,'page_kamar']);
Route::get('/costumer_service', function () {
    return redirect()->away('https://wa.me/6282282169581');
});

Route::post('/owner/set_jumlahkamar',[OwnerController::class,'set_jum_kamar']);
Route::post('/owner/set_hargakamar',[OwnerController::class,'set_harga_kamar']);  
Route::post('/owner/logout',[OwnerController::class,'owner_logout']);  
});
