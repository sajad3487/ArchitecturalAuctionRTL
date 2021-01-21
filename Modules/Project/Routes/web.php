<?php



Route::group(['prefix'=>'owner'],function (){
    Route::group(['prefix'=>'project'],function (){
        Route::get('/','ProjectController@all_owner_project');
        Route::get('/{project_id}/invoice','ProjectController@view_project_invoice');
        Route::get('/{project_id}/proposal','ProjectController@view_project_proposal');
        Route::get('/new','ProjectController@owner_new_project');
        Route::post('store','ProjectController@owner_store_project');
        Route::get('/active','ProjectController@owner_active_project');
        Route::get('/{project_id}/pay','ProjectController@owner_pay_project');
        Route::get('/{project_id}/view','ProjectController@owner_view_project');
        Route::get('/{project_id}/edit','ProjectController@owner_edit_project');
        Route::put('/{project_id}/update','ProjectController@owner_update_project');
        Route::put('/{project_id}/make_winner','ProjectController@owner_make_winner');

        Route::get('/search','ProjectController@searchOwnerProject');

        Route::get('{category_id}/get_category','ProjectController@owner_category');

    });

    Route::group(['prefix'=>'proposal'],function (){
        Route::get('/','ProposalController@index');
        Route::get('/{project_id}/view','ProposalController@show');
    });



});

Route::group(['prefix'=>'designer'],function () {
    Route::group(['prefix' => 'project'], function () {

        Route::get('/{project_id}/view','ProjectController@designer_view_project');
        Route::get('/won','ProjectController@designer_won_project');

        Route::get('/search','ProjectController@searchDesignerProject');

        Route::get('{category_id}/get_category','ProjectController@designer_category');

    });

    Route::group(['prefix' => 'proposal'], function () {

        Route::get('/','ProposalController@designer_proposal');
        Route::get('/{project_id}/create','ProposalController@designer_create_proposal');
        Route::post('/store','ProposalController@designer_store_proposal');
        Route::post('/{proposal_id}/add_file','ProposalController@designer_add_file_proposal');

    });

    Route::group(['prefix' => 'wall'], function () {

        Route::post('/store','WallController@designer_store_question');

    });

});
