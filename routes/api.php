<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::group(['prefix' => 'auth'], function ($router) {
    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::post('users','UserController@create')->name('user.create');
    Route::put('users/{user}','UserController@edit')->name('user.edit');
    Route::delete('users/{user}','UserController@remove')->name('user.delete');
    Route::post('articles','ArticleController@create')->name('article.create');
    Route::patch('articles/{article}','ArticleController@edit')->name('article.edit');
    Route::delete('articles/{article}','ArticleController@remove')->name('article.delete');
    Route::get('articles/{article}','ArticleController@show')->name('article.show');
    Route::get('users','UserController@searchUser')->name('search.user.name');
    Route::get('users/{user}/articles','UserController@showPost')->name('user.showPost');
    Route::get('users/{user}','UserController@fallow')->name('fallow.User');
    Route::get('articles/{article}/like','ArticleController@like')->name('users.articles.like');
    Route::get('articles','ArticleController@searchArticles')->name('articles.search');
    Route::post('articles/{article}/comment','CommentController@leaveComments')->name('users.leaveComments');
    Route::get('comments/{comment}/like','CommentController@likeComment')->name('users.comments.like');
    Route::get('articles','ArticleController@searchArticleStore')->name('users.searchArticle');
    Route::post('hashtag','HashtagController@create')->name('Hashtag.create');
    Route::post('articles/{article}/hashtags/{hashtag}', 'HashtagController@add')->name('articles.addHashtags');
    Route::get('articles/{article}/hashtags','HashtagController@index')->name('articles.indexHashtags');
    Route::get('hashtags/{hashtag}/articles','HashtagController@search')->name('articles.searchHashtags');
    Route::delete('hashtags/{hashtag}/articles','HashtagController@remove')->name('articles.removeHashtags');
    Route::get('hashtags','HashtagController@show')->name('Hashtags.show');









