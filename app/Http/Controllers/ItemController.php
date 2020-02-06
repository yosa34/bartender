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
use App\Entity\User;
use App\Entity\Item;
use App\DAO\UserDAO;
use App\DAO\ItemDAO;
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
class ItemController extends Controller{
    /**
     * レシピ
     */
    public function item(int $cocktail_id ,Request $request){
        $templatePath = "items.cocktail";

        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $assign["id"]=$request->session()->get('id');
            $assign["name"]=$request->session()->get('name');
            $assign["email"]=$request->session()->get('email');
            $db = DB::connection()->getPdo();
            $ItemDAO = new ItemDAO($db);
            $itemData = $ItemDAO->getItemInfo($cocktail_id);
            $assign["itemData"] = $itemData;
        }
        return view($templatePath,$assign);

    }
    /**
     * レシピ
     */
    public function recipe(int $recipe_id ,Request $request){
        $templatePath = "items.recipe";
        $id = $request->session()->get('id');
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $db = DB::connection()->getPdo();
            $ItemDAO = new ItemDAO($db);
            $recipeData = $ItemDAO->getRecipeInfo($recipe_id);
            // 履歴検索
            $history = $ItemDAO->findByHistory($recipe_id,$id);
            if(empty($history)){
                // 初めて回覧
                // 追加
                $ItemDAO->insertHistory($recipe_id,$id);
            }else{
                // 過去に回覧済み
                // 更新
                $ItemDAO->updateByHistory($recipe_id,$id);
            }

            $assign["recipeData"] = $recipeData;
            $assign["recipe_id"]=$recipe_id;
            $assign["id"]=$id;
            $assign["user"]=$request->session()->get('user');
            $assign["email"]=$request->session()->get('email');
            $assign["name"]=$request->session()->get('name');

        }
        return view($templatePath,$assign);

    }
}