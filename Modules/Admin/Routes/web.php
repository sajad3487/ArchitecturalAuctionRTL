<?php
\

Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::group(['middleware'=>'CheckAdmin'],function (){
        Route::get('/', 'AdminController@index');

        Route::group(['prefix'=>'categories'],function (){
            Route::get('/','AdminCategoryController@index');
            Route::get('create','AdminCategoryController@create');
            Route::post('store','AdminCategoryController@store');
            Route::get('{category_id}/delete','AdminCategoryController@destroy');
            Route::get('{category_id}/edit','AdminCategoryController@edit');
            Route::put('{category_id}/update','AdminCategoryController@update');
            Route::get('{category_id}/subCategory','AdminCategoryController@subCategory');
        });

        Route::get('/users','AdminController@customer');
        Route::get('/project','AdminController@project');

    });
});
