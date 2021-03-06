<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());	
});

Route::group(['middleware'=>'oauth'], function() {

	// Rotas relacionadas a Client

	Route::resource('client', 'ClientController', ['except'=>['create', 'edit']]);

	// Rotas relacionadas a ProjectFile

	Route::post('project/file', 'ProjectFileController@store');
	Route::delete('project/file/{file}', 'ProjectFileController@destroy');

	// Rotas relacionadas a ProjectTask

	Route::post('project/task', 'ProjectTaskController@store');

	Route::group(['middleware'=>'check-project-member'], function() {
		Route::get('project/task/{project}', 'ProjectTaskController@index');
		Route::get('project/task/{project}/{task}', 'ProjectTaskController@show');
	});

	Route::group(['middleware'=>'check-task-member'], function() {
		Route::delete('project/task/{task}', 'ProjectTaskController@destroy');
		Route::put('project/task/{task}', 'ProjectTaskController@update');
	});

	// Rotas relacionadas a ProjectMember

	Route::group(['middleware'=>'check-project-member'], function() {
		Route::get('project/member/{project}', 'ProjectController@indexMembers');
		Route::get('project/member/{project}/{member}', 'ProjectController@checkMember');
	});

	Route::group(['middleware'=>'check-project-owner'], function() {
		Route::post('project/member/{project}', 'ProjectController@storeMember');
		Route::delete('project/member/{project}/{member}', 'ProjectController@destroyMember');
	});

	// Rotas relacionadas a Project

	Route::get('project', 'ProjectController@index');
	Route::post('project', 'ProjectController@store');

	Route::group(['middleware'=>'check-project-member'], function() {
		Route::get('project/{project}', 'ProjectController@show');
	});

	Route::group(['middleware'=>'check-project-owner'], function() {
		Route::delete('project/{project}', 'ProjectController@destroy');
		Route::put('project/{project}', 'ProjectController@update');
	});

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


/*
|--------------------------------------------------------------------------
| Catching invalid routes
|--------------------------------------------------------------------------
*/
/*
Route::any( '{catchall}', function ( $page ) {
    return [
        'error' => true,
        'message' => 'Rota invalida!',
    ];
});
*/

