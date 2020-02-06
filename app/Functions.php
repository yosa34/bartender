<?php

/**
 * PH34 Sample11 マスタテーブル管理Laravel版　Src02/17
 * ルーティング情報記述ファイル
 *
 * @author Shinzo SAITO
 *
 * ファイル名＝Functions.php
 * ディレクトリ＝/work3/ph34/scottadminlaravel/app/
 */

 namespace App;

 use Illuminate\Http\Request;

 /**
  * 共通処理が書かれたクラス。
  */
  class Functions{
      /**
       * ログイン済みかどうかとチェックする関数
       * セッションからログイン情報」が見つからない場合はログイン状態と判定する。
       * 
       * @param Request $request リクエストオブジェクト。
       * @return boolean ログアウト状態の場合はtrue、ログイン状態の場合はfalse。
       */
      public static function loginCheck(Request $request) :bool{
        $result = false;
        $session = $request->session();
        // var_dump($session);
        if(!$session->has("loginFlg") || $session->get("loginFlg") == false || !$session->has("email") || !$session->has("name") || !$session->has("auth")){
            $result = true;
        }
        return $result;
      }
  }