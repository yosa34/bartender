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
Route::get('/', function () {
    return view('top');
});
// ログイン
Route::get("/login","LoginController@login");
Route::post("/goLogin","LoginController@goLogin");
// ログアウト
Route::get("/logout","LoginController@logout");
// 会員登録
Route::get("/register","RegisterController@register");
Route::post("/goRegister","RegisterController@goRegister");

// ホーム画面
// 特集
Route::get('/mainpage/topics',"TopController@topics");
// ランキング
Route::get('/mainpage/ranking',"TopController@ranking");
// おすすめ
Route::get('/mainpage/recommend',"TopController@recommend");
// 検索
Route::get('/mainpage/goSearch/{name}',"SearchController@goSearch");
Route::get('/mainpage/goCategorySearch/{id}',"SearchController@goCategorySearch");
// API
Route::get('/mainpage/goCategoryReSearch/{id}',"ApiController@goCategoryReSearch");
Route::get('/mainpage/goCocktailSearch/{id}',"ApiController@goCocktailSearch");
// Good
Route::get('/user/getgoodFlg/{id}',"ApiController@getgoodFlg");
Route::get('/user/goodCocktail/{id}',"ApiController@goodCocktail");
Route::get('/user/deleteGoodCocktail/{id}',"ApiController@deleteGoodCocktail");
// Kurt
Route::get('/user/getKurtFlg/{id}',"ApiController@getKurtFlg");
Route::get('/user/kurtItem/{id}',"ApiController@kurtItem");
Route::get('/user/deleteKurtItem/{id}',"ApiController@deleteKurtItem");
Route::get('/user/getKurtPurchase',"ApiController@getKurtPurchase");
// List
Route::get('/user/getKurtList',"ApiController@getKurtList");
Route::get('/user/getViewList',"ApiController@getViewList");
Route::get('/user/getGoodList',"ApiController@getGoodList");
Route::get('/user/getPurchaseList',"ApiController@getPurchaseList");

// データ取得
// カテゴリーAPI
Route::get('/mainpage/getCategoryBase',"ApiController@getCategoryBase");

// ユーザー情報画面
Route::get('/user/userHome',"UserController@userHome");
// ユーザー情報編集画面
Route::get("/user/userEdit","UserController@userEdit");
Route::post("/goUserEdit","UserController@goUserEdit");

// レシピ詳細画面
Route::get("/items/recipe/{id}","ItemController@recipe");
Route::get('/user/getRecipeItemList/{id}',"ApiController@getRecipeItemList");

// カクテル詳細画面
Route::get("/items/item/{id}","ItemController@item");
