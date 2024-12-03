<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Actl\PostalCodeController;
use App\Http\Controllers\Actl\SupplierController;
use App\Http\Controllers\Actl\FamilyController;
use App\Http\Controllers\Actl\UnitMesureController;
use App\Http\Controllers\Actl\TaxRateController;


Route::get('/', function () {
    return view('welcome');
});

 // Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(PostalCodeController::class)->group(function(){
    Route::get('/postalCode/all', 'PostalCodeAll')->name('postalCode.all');
    Route::get('/postalCode/add', 'PostalCodeAdd')->name('postalCode.add');
    Route::post('/postalCode/store', 'PostalCodeStore')->name('postalCode.store');
    Route::get('/postalCode/edit/{id}', 'PostalCodeEdit')->name('postalCode.edit');
    Route::post('/postalCode/update', 'PostalCodeUpdate')->name('postalCode.update');
    Route::get('/postalCode/delete/{id}', 'PostalCodeDelete')->name('postalCode.delete');
});
Route::controller(SupplierController::class)->group(function(){
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
});
Route::controller(FamilyController::class)->group(function(){
    Route::get('/family/all', 'FamilyAll')->name('family.all');
    Route::get('/family/add', 'FamilyAdd')->name('family.add');
    Route::post('/family/store', 'FamilyStore')->name('family.store');
    Route::get('/family/edit/{id}', 'FamilyEdit')->name('family.edit');
    Route::post('/family/update', 'FamilyUpdate')->name('family.update');
    Route::get('/family/delete/{id}', 'FamilyDelete')->name('family.delete');
});
Route::controller(UnitMesureController::class)->group(function(){
    Route::get('/unitMesure/all', 'UnitMesureAll')->name('unitMesure.all');
    Route::get('/unitMesure/add', 'UnitMesureAdd')->name('unitMesure.add');
    Route::post('/unitMesure/store', 'UnitMesureStore')->name('unitMesure.store');
    Route::get('/unitMesure/edit/{id}', 'UnitMesureEdit')->name('unitMesure.edit');
    Route::post('/unitMesure/update', 'UnitMesureUpdate')->name('unitMesure.update');
    Route::get('/unitMesure/delete/{id}', 'UnitMesureDelete')->name('unitMesure.delete');
});
Route::controller(TaxRateController::class)->group(function(){
    Route::get('/taxRate/all', 'TaxRateAll')->name('taxRate.all');
    Route::get('/taxRate/add', 'TaxRateAdd')->name('taxRate.add');
    Route::post('/taxRate/store', 'TaxRateStore')->name('taxRate.store');
    Route::get('/taxRate/edit/{id}', 'TaxRateEdit')->name('taxRate.edit');
    Route::post('/taxRate/update', 'TaxRateUpdate')->name('taxRate.update');
    Route::get('/taxRate/delete/{id}', 'TaxRateDelete')->name('taxRate.delete');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');
require __DIR__.'/auth.php';
