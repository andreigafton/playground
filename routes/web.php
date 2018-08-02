<?php

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

Auth::routes();

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', function(){
            return view('backend.index');
        })->name('admin');

        Route::resource('settings', 'SettingController')
            ->only(['index', 'edit', 'update'])
            ->names([
                'index' => 'settings.index',
                'edit' => 'settings.edit',
                'update' => 'settings.update',
            ]);

        Route::resource('results', 'GroupResultController')
            ->only(['index'])
            ->names([
                'index' => 'results.index',
            ]);

    });

Route::get('/', 'HomeController@index')->name('home');

Route::resource('color', 'ColorController')
    ->only(['store'])
    ->names([
        'store' => 'color.store',
    ]);


