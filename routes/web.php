<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('pilots')->name('pilots/')->group(static function() {
            Route::get('/',                                             'PilotsController@index')->name('index');
            Route::get('/create',                                       'PilotsController@create')->name('create');
            Route::post('/',                                            'PilotsController@store')->name('store');
            Route::get('/{pilot}/edit',                                 'PilotsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PilotsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{pilot}',                                     'PilotsController@update')->name('update');
            Route::delete('/{pilot}',                                   'PilotsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('cars')->name('cars/')->group(static function() {
            Route::get('/',                                             'CarsController@index')->name('index');
            Route::get('/create',                                       'CarsController@create')->name('create');
            Route::post('/',                                            'CarsController@store')->name('store');
            Route::get('/{car}/edit',                                   'CarsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CarsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{car}',                                       'CarsController@update')->name('update');
            Route::delete('/{car}',                                     'CarsController@destroy')->name('destroy');
        });
    });
});