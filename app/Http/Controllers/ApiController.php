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
use App\DAO\ApiDAO;
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
class ApiController extends Controller{


    /*
    * 検索用のベースカテゴリの取得
    */
    public function getCategoryBase(){

        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        $ApiDAO->findAll();
    }
    /*
        ID再検索
    */
    public function goCategoryReSearch(int $id){
        $assign = [];

        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        $itemList = $ApiDAO->apiSearchItemId($id);
        $item_array = array();
        $cnt = 0;
        foreach($itemList as $items){
            $item_array[$cnt]["id"] = $items->getItemId();
            $item_array[$cnt]["name"] = $items->getItemName();
            $item_array[$cnt]["price"] = $items->getPrice();
            $cnt++;
        }

        $itemListEnco = json_encode($item_array);
        echo $itemListEnco;

        $assign["itemList"] = $itemList;
    }
    /*
        レシピ素材
    */
    public function goCocktailSearch(int $id){
        $assign = [];

        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        $cocktailList = $ApiDAO->apiSearchCocktailId($id);
        $cocktail_array = array();
        $cnt = 0;
        foreach($cocktailList as $cocktails){
            $cocktail_array[$cnt]["item_id"] = $cocktails->getItemId();
            $cocktail_array[$cnt]["recipe_id"] = $cocktails->getRecipeId();
            $cocktail_array[$cnt]["recipe_name"] = $cocktails->getRecipeName();
            $cnt++;
        }

        $cocktail_ListEnco = json_encode($cocktail_array);
        echo $cocktail_ListEnco;

        $assign["itemList"] = $cocktailList;
    }
    /*
        レシピ素材検索
    */
    public function getRecipeItemList(int $id){
        $assign = [];

        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        $recipeItemList = $ApiDAO->apiRecipeItemId($id);
        $resipe_item_array = array();
        $cnt = 0;
        foreach($recipeItemList as $recipeItems){
            $resipe_item_array[$cnt]["item_id"] = $recipeItems->getItemId();
            $resipe_item_array[$cnt]["recipe_id"] = $recipeItems->getRecipeId();
            $resipe_item_array[$cnt]["item_name"] = $recipeItems->getItemName();
            $cnt++;
        }
        $recipeItem_ListEnco = json_encode($resipe_item_array);
        echo $recipeItem_ListEnco;


        $assign["recipeItemList"] = $recipeItemList;
    }
    /*
        お気に入り登録
    */
    public function goodCocktail(int $id,Request $request){
        // dd($id);
        $user_id = $request->session()->get('id');
        $isRedirect = false;
        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        // dd($user_id);
        $goodFlg = $ApiDAO->apiGoodCocktail($id,$user_id);
        if($goodFlg === -1){
            $isRedirect = false;
        }else{
            $isRedirect = true;
        }
        echo $isRedirect;
    }

    /*
        お気に入り解除
    */
    public function deleteGoodCocktail(int $id,Request $request){
        $isRedirect = false;
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $goodFlg = $ApiDAO->apiDeleteGoodCocktail($id,$user_id);
            if($goodFlg === -1){
                $isRedirect = false;
            }else{
                $isRedirect = true;
            }
        }
        echo $isRedirect;
    }

    /*
        お気に入り表示
    */
    public function getgoodFlg(int $id,Request $request){
        $goodFlg = false;
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');
            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $goodFlg = $ApiDAO->apiGetGoodFlg($id,$user_id);
        }
        echo $goodFlg;
    }
    /*
        カート登録
    */
    public function kurtItem(int $id,Request $request){
        // dd($id);
        $user_id = $request->session()->get('id');
        $isRedirect = false;
        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        // dd($user_id);
        $kurtFlg = $ApiDAO->apiKurtItem($id,$user_id);
        if($kurtFlg === -1){
            $isRedirect = false;
        }else{
            $isRedirect = true;
        }
        echo $isRedirect;
    }

    /*
        カート解除
    */
    public function deleteKurtItem(int $id,Request $request){
        $isRedirect = false;

        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtFlg = $ApiDAO->apiDeleteKurtItem($id,$user_id);
            if($kurtFlg === -1){
                $isRedirect = false;
            }else{
                $isRedirect = true;
            }
        }
        echo $isRedirect;
    }

    /*
        カート表示
    */
    public function getKurtFlg(int $id,Request $request){
        $kurtFlg = false;
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');
            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtFlg = $ApiDAO->apiGetKurtFlg($id,$user_id);
        }
        echo $kurtFlg;
    }
    /*
        カート登録
    */
    public function getKurtPurchase(Request $request){
        // dd($id);
        $user_id = $request->session()->get('id');
        $isRedirect = false;
        $db = DB::connection()->getPdo();
        $ApiDAO = new ApiDAO($db);
        $kurtFlg = $ApiDAO->apiGetKurtPurchase($user_id);
        if($kurtFlg === -1){
            $isRedirect = false;
        }else{
            $isRedirect = true;
        }
        echo $isRedirect;
    }
    /*
        カートリスト取得
    */
    public function getKurtList(Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->apiGetKurtList($user_id);
            $cocktail_array = array();
            $cnt = 0;
            foreach($kurtList as $kurt){
                $cocktail_array[$cnt]["item_id"] = $kurt->getItemId();
                $cocktail_array[$cnt]["item_name"] = $kurt->getItemName();
                $cocktail_array[$cnt]["price"] = $kurt->getPrice();
                $cocktail_array[$cnt]["quantity"] = $kurt->getQuantity();
                $cocktail_array[$cnt]["alcohol"] = $kurt->getAlcohol();
                $cnt++;
            }

            $cocktail_ListEnco = json_encode($cocktail_array);
        }
        echo $cocktail_ListEnco;

        $assign["itemList"] = $kurtList;
    }
    /*
        閲覧履歴リスト取得
    */
    public function getViewList(Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->apiGetViewList($user_id);
            $cocktail_array = array();
            $cnt = 0;
            foreach($kurtList as $kurt){
                $cocktail_array[$cnt]["item_id"] = $kurt->getItemId();
                $cocktail_array[$cnt]["item_name"] = $kurt->getItemName();
                $cocktail_array[$cnt]["time"] = $kurt->getTime();
                $cnt++;
            }

            $cocktail_ListEnco = json_encode($cocktail_array);
        }
        echo $cocktail_ListEnco;

        $assign["itemList"] = $kurtList;

    }
    /*
        お気に入りリスト取得
    */
    public function getGoodList(Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->apiGetGoodList($user_id);
            $cocktail_array = array();
            $cnt = 0;
            foreach($kurtList as $kurt){
                $cocktail_array[$cnt]["item_id"] = $kurt->getItemId();
                $cocktail_array[$cnt]["item_name"] = $kurt->getItemName();
                $cnt++;
            }

            $cocktail_ListEnco = json_encode($cocktail_array);
        }
        echo $cocktail_ListEnco;

        $assign["itemList"] = $kurtList;

    }
    /*
        過去購入履歴リスト取得
    */
    public function getPurchaseList(Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->apiGetReKurtList($user_id);
            $cocktail_array = array();
            $cnt = 0;
            foreach($kurtList as $kurt){
                $cocktail_array[$cnt]["item_id"] = $kurt->getItemId();
                $cocktail_array[$cnt]["item_name"] = $kurt->getItemName();
                $cocktail_array[$cnt]["purchase_time"] = $kurt->getPurchaseTime();
                $cnt++;
            }

            $cocktail_ListEnco = json_encode($cocktail_array);
        }
        echo $cocktail_ListEnco;

        $assign["itemList"] = $kurtList;

    }
    /*
        リキュール別コメント取得
    */
    public function getReviewList(int $id,Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->apiGetReviewList($id);
            $cocktail_array = array();
            $cnt = 0;
            foreach($kurtList as $kurt){
                $cocktail_array[$cnt]["review_id"] = $kurt->getReviewId();
                $cocktail_array[$cnt]["review"] = $kurt->getReview();
                $cocktail_array[$cnt]["create_time"] = $kurt->getTime();
                $cnt++;
            }

            $cocktail_ListEnco = json_encode($cocktail_array);
        }
        echo $cocktail_ListEnco;

        $assign["itemList"] = $kurtList;

    }
    /*
        リキュール別コメント取得
    */
    public function setReviewList(int $id,$review,Request $request){
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";

            return view($templatePath,$assign);
        }else{
            $user_id = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $ApiDAO = new ApiDAO($db);
            $kurtList = $ApiDAO->insertReview($id,$user_id,$review);
        }
    }
}