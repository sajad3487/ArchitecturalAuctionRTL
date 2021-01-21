<?php

Route::group(['prefix'=>'media'],function (){

    Route::group(['prefix'=>'owner'],function (){
        Route::get('{media_id}/delete','MediaController@destroy');
        Route::post('{project_id}/upload_project_image','MediaController@ownerUploadImageProject');
    });

});
