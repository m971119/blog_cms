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

Route::get('/', 'HomeController@index');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// we use Route::name to add prefix admin. to the route, to prevent route conflict with the front side
Route::name('admin.')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', 'AdminController@index');
        // Route::resource('admin/users', ['as'=>'routeName'], 'AdminUsersController');
        Route::resource('/admin/users', 'AdminUsersController');
        Route::resource('/admin/posts', 'AdminPostsController');
        Route::resource('/admin/categories', 'AdminCategoriesController');
        Route::resource('/admin/media', 'AdminMediasController');
        Route::resource('/admin/comments', 'PostsCommentsController');
        Route::resource('/admin/comments/replies', 'CommentsRepliesController');
    });
    Route::middleware(['auth'])->group(function () {
        Route::post('comment/reply', 'CommentsRepliesController@createReply');
    });
});


Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'HomeController@post']);
