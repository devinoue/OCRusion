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



Route::get('/',function(){
    return view('index');
});

Route::group(['middleware'=>'auth'],function(){

    Route::post('/register_dir','OCRusionController@registerDir');
    Route::get('/dashboard','DashboardController@dashboard');
    Route::get('/dashboard/tmp/{target_dir}','DashboardController@disp');
    Route::get('/upload_front','DashboardController@upload_front');
    Route::delete('/delete','DashboardController@deleteDir');

});

// Cron及び手動による処理
Route::get('/batch','OCRusionController@ocrBatch');

// その他のページ
Route::get('/contact',function(){return view('policies.contact');});
Route::get('/privacy',function(){return view('policies.privacy');});


// ログアウト用
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();
