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

Route::get('/', 'PostsController@home');

//view post
Route::get('/post/{id}','Controller@post')->name('post');
//delete post
Route::get('delete_post/{id}','Controller@delete_post');
//insert ans
Route::post('insert_ans','Controller@insert_ans');
//delete ans
Route::get('delete_ans/{id}','Controller@delete_ans');
//form edit ans
Route::get('form_edit_ans/{id}','Controller@form_edit_ans');
//edit ans success
Route::post('edit_ans','Controller@edit_ans');
//confirm ans
Route::get('confirm_ans/{id}','Controller@confirm_ans');
//like ans
Route::get('like_ans/{id}','Controller@like_ans');
//dislike ans
Route::get('dislike_ans/{id}','Controller@dislike_ans');
//conment
Route::post('comments','Controller@comments');
//update like ans
Route::get('update_like_ans/{id}','Controller@update_like_ans');
//update dislike ans
Route::get('update_dislike_ans/{id}','Controller@update_dislike_ans');

//------------------------------------------------------------------
//view Article
Route::get('article/{id}','Controller@article')->name('article');
//delete article
Route::get('delete_article/{id}','Controller@delete_article');
//confirm article
Route::get('confirm_article/{id}','Controller@confirm_article');
//like article
Route::get('like_article/{id}','Controller@like_article');
//dislike article
Route::get('dislike_article/{id}','Controller@dislike_article');
//update dislike article
Route::get('update_dislike_article/{id}','Controller@update_dislike_article');
//update like article
Route::get('update_like_article/{id}','Controller@update_like_article');

//-----------------------------------------------------------------
//report post and article
Route::get('report_post/{id}','Controller@report_post');
//---------------------------------------------------------------
//admin and register
// Route::get('/admin1', function () {
//     return view('admin1');
// });

// Route::get('/admin2', function () {
//     return view('admin2');
// });

Route::get('admin1','AdminModelController@admin1');
Route::get('admin2','AdminModelController@admin2');
Route::get('check-model','AdminModelController@admin3');

Route::get('banupdate/{id}','AdminModelController@banupdate');
Route::get('rebanupdate/{id}','AdminModelController@rebanupdate');

Route::get('approve/{id}','AdminModelController@approve');
Route::get('noapprove/{id}','AdminModelController@noapprove');

Route::get('/register', function () {
    return view('Register');
});

Route::post('/registersave', 'AdminModelController@register')->name('register1');

//------------------------------------------------------------------------------------
//หน้าแรก หน้าหมวดหมู่

Route::get('home','PostsController@home')->name('home');

//Category
Route::get('math','PostsController@math');

Route::get('science','PostsController@science');

Route::get('social','PostsController@social');

Route::get('language','PostsController@language');

Route::get('arts','PostsController@arts');

Route::get('general','PostsController@general');

//Route All Post
Route::get('home/allpost','PostsController@homeAllPost');

Route::get('math/allpost','PostsController@mathAllPost');

Route::get('science/allpost','PostsController@scienceAllPost');

Route::get('social/allpost','PostsController@socialAllPost');

Route::get('language/allpost','PostsController@languageAllPost');

Route::get('arts/allpost','PostsController@artsAllPost');

Route::get('general/allpost','PostsController@generalAllPost');

//Route All Blog
Route::get('home/allblog','PostsController@homeAllBlog');

Route::get('math/allblog','PostsController@mathAllBlog');

Route::get('science/allblog','PostsController@scienceAllBlog');

Route::get('social/allblog','PostsController@socialAllBlog');

Route::get('language/allblog','PostsController@languageAllBlog');

Route::get('arts/allblog','PostsController@artsAllBlog');

Route::get('general/allblog','PostsController@generalAllBlog');

//------------------------------------
//login, ผู้จัดทำ
Route::post('login_c', 'ProfileController@login_check');

Route::get('/Contact', function () {
    return view('Contact');
});

Route::get('/About_us', function () {
    return view('About_us');
});

Route::get('Logout', 'ProfileController@logout');
//-----------------------------------------
//profile

Route::get('/search','SearchController@index');
Route::get('/autocompleteName', 'SearchController@searchName');
Route::get('/autocompleteTitle', 'SearchController@searchTitle');
Route::post('search_result','SearchController@search_result');

/*Edit profile */
Route::get('/edit_profile/{id}','ProfileController@editProfile');
Route::post('/edit_profiles','ProfileController@update');


Route::get('/profile','ProfileController@index');
Route::get('/profiles/{id}','ProfileController@profile');

//--------------------------------------------------------------
//create post and article

Route::get('/showpost', function () {
    return view('post');
});

Route::get('/showarticle', function () {
    return view('article');
});

Route::post('/summernotepost','PostsController@store')->name('summernoteMessagepost');
Route::post('/summernotearticle','PostsController@store2')->name('summernoteMessagearticle');
Route::post('/editsummernote{id}','PostsController@update')->name('editsummernoteMessage');
Route::get('/edit{id}','PostsController@edit')->name('edit');



