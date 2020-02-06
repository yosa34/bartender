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
class TopController extends Controller{
    /**
     * TOPICS
     */
    public function topics(Request $request){
        $templatePath = "mainpage.topics";
        $assign = [];
        // dd($request->session());
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $assign["name"]=$request->session()->get('name');
            $templatePath = "mainpage.topics";
        }
        return view($templatePath,$assign);
    }

    /**
     * RANKING
     */
    public function ranking(Request $request){
        $templatePath = "mainpage.ranking";
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $assign["name"]=$request->session()->get('name');
            $templatePath = "mainpage.ranking";
        }
        return view($templatePath,$assign);
    }
    /**
     * RECOMMEND
     */
    public function recommend(Request $request){
        $templatePath = "mainpage.recommend";
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $assign["name"]=$request->session()->get('name');
            $templatePath = "mainpage.recommend";
        }
        return view($templatePath,$assign);
    }
}
