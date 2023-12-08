<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypesController;
use App\Http\Controllers\Backend\PropertyController;


Route::get('/', [UserController::class, 'Index']);


 

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',function(){return view('dashboard');})->name('user.dashboard');
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/password/change', [UserController::class, 'userPasswordChange'])->name('user.password.change');
    Route::post('/user/password/update', [UserController::class, 'userPasswordUpdate'])->name('user.password.update');
});

require __DIR__.'/auth.php';

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});//End of Admin Middleware





//Admin All Category Types
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyTypesController::class)->group(function(){
        Route::get('/all/types', 'AllTypes')->name('all.types');
        Route::get('/add/types', 'AddTypes')->name('add.types');
        Route::post('/store/types', 'StoreTypes')->name('store.types');
        Route::get('/edit/types/{id}', 'EditTypes')->name('edit.types');
        Route::post('/update/types/{id}', 'UpdateTypes')->name('update.types');
        Route::get('/delete/types/{id}', 'DeleteTypes')->name('delete.types');
    });
});//End of Admin All Category Types Middleware


//Admin All Amenities
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyTypesController::class)->group(function(){
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenity')->name('add.amenities');
        Route::post('/store/amenity', 'StoreAmenity')->name('store.amenity');
        Route::get('/edit/amenity/{id}', 'EditAmenity')->name('edit.amenity');
        Route::post('/update/amenity', 'UpdateAmenity')->name('update.amenity');
        Route::get('/delete/amenity/{id}', 'DeleteAmenity')->name('delete.amenity');
    });
});//End of Admin All Amenities Middleware


//Admin All Properties
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyController::class)->group(function(){
        Route::get('/all/properties', 'AllProperties')->name('all.properties');
        Route::get('/add/property', 'AddProperty')->name('add.property');
       
    });
});//End of Admin All Properties Middleware




Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});//End of Agent Middleware



