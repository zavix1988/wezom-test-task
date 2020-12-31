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



Auth::routes(['register' => false]);


Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth']
    ],
    function(){
        Route::get('/', function(){
            return redirect()->route('admin.news.index');
        });
        Route::resource('/news', 'NewsController', ['as' => 'admin']);
        Route::resource('/reviews', 'ReviewsController', ['as' => 'admin']);
        Route::put('/reviews/{id}/publish', 'ReviewsController@publish')->name('admin.reviews.publish');
    }
);
Route::get('/', function(){
    return redirect()->route('common.news.index');
});
Route::resource('/news', 'NewsController', ['as' => 'common'])->only([ 'index', 'show' ]);
Route::get('/news/{sort?}/sort/{direction?}', 'NewsController@index')->name('common.news.sort');
Route::resource('/reviews', 'ReviewsController', ['as' => 'common'])->only([ 'index', 'create', 'store' ]);
Route::get('/reload-captcha', function(){
    return response()->json(['captcha'=> captcha_img()]);
});

