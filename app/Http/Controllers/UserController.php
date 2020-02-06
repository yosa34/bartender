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
use App\DAO\UserDAO;
use App\Functions;
use App\Entity\User;
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
class UserController extends Controller{
    /**
     * ユーザー情報表示画面
     */
    public function userHome(Request $request){
        $templatePath = "user.userHome";
        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[]="ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $id = $request->session()->get('id');
            $name = $request->session()->get('name');
            $email=$request->session()->get('email');

            $user = new User();
            $user->setName($name);
            $user->setId($id);
            $user->setEmail($email);

            $assign["name"] = $name;
            $assign["email"] = $email;
        }
        return view($templatePath,$assign);
    }

    /*
     * ユーザー情報編集
     */
    public function userEdit(Request $request){
        $templatePath = "user.userHome";
        $assign = [];

        if(Functions::loginCheck($request)){
            $validationMsgs[] = "ログインしていないから、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $name=$request->session()->get('name');
            $email=$request->session()->get('email');

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);

            $session = $request->session();
            $session->put("email", $user->getEmail());
            $session->put("name", $user->getName());
            $assign["user"] = $user;

            $templatePath = "user.userEdit";
        }

        return view($templatePath,$assign);
    }

    /*
     * ユーザー情報編集処理
     */
    public function goUserEdit(Request $request){
        $templatePath = "user.userEdit";
        $isRedirect = false;

        $assign = [];
        if(Functions::loginCheck($request)){
            $validationMsgs[] = "ログインしていないから、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
            $assign["validationMsgs"] = $validationMsgs;
            $templatePath = "login";
        }else{
            $addName = $request->input("name");
            $addEmail = $request->input("email");

            $addName = trim($addName);
            $addEmail = trim($addEmail);

            $user = new User();
            $user->setName($addName);
            $user->setEmail($addEmail);
            $validationMsgs = [];

            $db = DB::connection()->getPdo();
            $userDAO = new UserDAO($db);
            if(empty($validationMsgs)){
                // 更新処理
                $username = $userDAO->update($user);
                if($username === -1){
                    // 失敗
                    $assign["errorMsg"] = "ユーザー登録に失敗しました。もう一度初めからやり直してください。";
                    $templatePath = "user.userEdit";
                }else{
                    // 成功
                    $templatePath = "user.userHome";
                    $session = $request->session();
                    $session->put("email", $user->getEmail());
                    $session->put("name", $user->getName());

                    $isRedirect = true;
                }
            }else{
                $assign["user"] = $user;
                $assign["name"]=$request->session()->get('name');
                $assign["email"]=$request->session()->get('email');
                $assign["validationMsgs"] = $validationMsgs;
            }


        }
        if($isRedirect){
            $response = redirect("/user/userHome")->with("flashMsg","ユーザーデータを更新しました。");
        }else{
            $response = view($templatePath,$assign);
        }
        return $response;
    }
}
