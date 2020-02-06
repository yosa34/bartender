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

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Entity\User;
use App\Functions;
use App\DAO\UserDAO;
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
class RegisterController extends Controller{
    /**
     * 新規登録画面表示処理。
     */
    public function register(){
        $templatePath = "register";
        $assign = [];
        $assign["user"] = new User();
        return view($templatePath,$assign);
    }
    /**
     * 新規登録画面表示処理。
     */
    public function goRegister(Request $request){
        $templatePath = "register";
        $isRedirect = false;
        $assign = [];

        $addName = $request->input("name");
        $addEmail = $request->input("email");
        $addPasswd = $request->input("passwd");

        $addName = trim($addName);
        $addEmail = trim($addEmail);
        $addPasswd = trim($addPasswd);
        $hash_pass = password_hash($addPasswd, PASSWORD_DEFAULT);

        $user = new User();
        $user->setName($addName);
        $user->setEmail($addEmail);
        $user->setPasswd($hash_pass);

        $validationMsgs = [];
        // dd(DB::table('users'));
        $db = DB::connection()->getPdo();
        $userDAO = new UserDAO($db);
        $userDB = $userDAO->findByUserNo($user->getEmail());
        // dd($userDB);
        if(!empty($userDB)){
            $validationMsgs[] = "そのメールアドレスはすでに使われています。別のものを指定してください";
        }else{
        }
        if(empty($validationMsgs)){
            // 新規登録
            $username = $userDAO->insert($user);
            if($username === -1){
                $assign["errorMsg"] = "ユーザー登録に失敗しました。もう一度初めからやり直してください。";
                $templatePath = "register";
            }else{
                $session = $request->session();
                $session->put("loginFlg", true);
                $session->put("id", $username);
                $session->put("email", $user->getEmail());
                $session->put("name", $user->getName());
                $session->put("auth", 1);
                $isRedirect = true;
            }
        }else{
            $assign["user"] = $user;
            $assign["validationMsgs"] = $validationMsgs;
        }

        if($isRedirect){
            $response = redirect("/mainpage/topics")->with("flashMsg","Welcome to ".$username);
        }else{
            $response = view($templatePath,$assign);
        }
        // dd($user);

        return $response;
    }

}
