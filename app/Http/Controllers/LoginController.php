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
class LoginController extends Controller{
    /**
     * ログイン画面表示処理。
     */
    public function login(){
        $templatePath = "login";
        $assign = [];
        $assign["user"] = new User();
        return view($templatePath,$assign);
    }

    /**
     * ログイン処理
     * 
     * 引数は型指定をしないと渡してくれない
     */
    public function goLogin(Request $request){
        $isRedirect = false;
        $templatePath = "login";
        $assign = [];

        $loginId = $request->input("loginId");
        $loginPw = $request->input("loginPw");

        $loginId = trim($loginId);
        $loginPw = trim($loginPw);

        $valigationMsgs = [];
        if(empty($valigationMsgs)){
            $db = DB::connection()->getPdo();
            $userDAO = new UserDAO($db);

            $user = $userDAO->findByLoginid($loginId);

            if($user == null){
                $valigationMsgs[] = "存在しないでメールアドレスです。正しいメールアドレスを入力してください。";
            }else{
                $userPw = $user->getPasswd();
                if(password_verify($loginPw,$userPw)){
                    $id = $user->getId();
                    $name = $user->getName();
                    $email = $user->getEmail();

                    $session = $request->session();
                    $session->put("loginFlg", true);
                    $session->put("id", $id);
                    $session->put("name", $name);
                    $session->put("email", $email);
                    $session->put("auth", 1);
                    $isRedirect = true;
                }else{
                    $valigationMsgs[] = "パスワードが違います。正しいパスワードを入力してください。";
                }//password_verify($loginPw,$userPw)
            }//$user == null)
        }//empty($valigationMsgs)
        if($isRedirect){
            $response = redirect("/mainpage/topics");
        }else{
            if(!empty($valigationMsgs)){
                $assign["valigationMsgs"]=$valigationMsgs;
                $assign["loginId"]=$loginId;
            }//!empty($valigationMsgs)
            $response = view($templatePath,$assign);
        }//$isRedirect
        return $response;
    }
    /**
     * ログアウト処理
     */
    public function logout(Request $request){
        $session = $request->session();
        $session->flush();
        $session->regenerate();
        return redirect("/");
    }
}
