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

Auth::routes();
//Route::post('login',function (Request $request){
//        dd($request->all());
//});
Route::group(['middleware'=>'auth'],function (){
   Route::group(['prefix'=>'designer','middleware'=>'CheckUser'],function (){

       Route::get('/', 'HomeController@designer_index')->name('home');
       Route::group(['prefix'=>'profile'],function (){
           Route::get('/','HomeController@designer_profile');
           Route::post('/update','HomeController@updateProfile');
       });

//       Route::get('/category/{category_id}', 'HomeController@indexCategory');

   });

    Route::group(['prefix'=>'owner','middleware'=>'CheckOwner'],function (){

        Route::get('/','HomeController@owner_index');
        Route::group(['prefix'=>'profile'],function (){
            Route::get('/','HomeController@owner_profile');
            Route::post('/update','HomeController@updateProfile');
        });
    });
});

Route::get('/designer_register', function (){
    return view('auth.designer_register');
});

Route::get('home',function (){
    return redirect('designer');
});
