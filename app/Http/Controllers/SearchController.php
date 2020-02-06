<?php

/**
 * PH34 Sample11 マスタテーブル管理Laravel版　Src09/17
 * ルーティング情報記述ファイル
 *
 * @author Shinzo SAITO
 *
 * LoginController.php
 * ディレクトリ＝/work3/ph34/scottadminlaravel/app/Http/Controllers/
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Functions;
use App\DAO\SearchDAO;
use App\Http\Controllers\Controller;


/**
 * ログイン・ログアウトに関するコントローラクラス。
 *
 * --------------------------------------------
 * extends　右を左に継承する。
 *
 * 
 * --------------------------------------------
 */
class SearchController extends Controller{
    /**
     * サーチ画面表示
     */
    // public function search(Request $request){

    // }
    /**
     * カクテル名検索
     */
    public function goSearch(string $name,Request $request){
        $templatePath = "mainpage.topics";
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $assign["user"]=$request->session()->get('user');
            $assign["name"]=$request->session()->get('name');
            $assign["email"]=$request->session()->get('email');
            $templatePath = "mainpage.search";
        }
        return view($templatePath,$assign);

    }
    /**
     * カテゴリ検索
     */
    public function goCategorySearch(int $id ,Request $request){
        $templatePath = "mainpage.search";
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{

            $db = DB::connection()->getPdo();
            $SearchDAO = new SearchDAO($db);
            $itemList = $SearchDAO->searchItemId($id);

            $assign["itemList"] = $itemList;
            $assign["user"]=$request->session()->get('user');
            $assign["name"]=$request->session()->get('name');
            $assign["email"]=$request->session()->get('email');
        }
        return view($templatePath,$assign);
    }
}