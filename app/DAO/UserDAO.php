<?php
/**
 *PH34 サンプル9　マスタテーブル管理D完版　Sro07/02
 *
 * @author Shinzo SAITO
 * 
 * ファイル名　＝　UserDAO.php
 * ディレクトリ　＝　/work3/ph34/scottadminkan/classes/dao/
 */
/**
 * deptテーブルへのデータ操作クラス
 */
namespace App\DAO;

use PDO;
use App\Entity\User;

/**
 * usersテーブルへのデータ操作クラス
 */
class UserDAO{
    /**
     * @var PDO DB接続オブジェクト
     */
    private $db;
    /**
     * コンストラクタ
     * 
     * @param PDO $db DB接続オブジェクト
     * newした瞬間に処理が実行される
     */
    public function __construct(PDO $db){
        $db-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db-> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        // FETCHのバージョンをASSOCに変更
        $db-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $this->db = $db;
    }
    /**
     * ログインidによるログイン
     * 
     * @param integer $loginId ログインid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function findByLoginid(string $loginId):?User{
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":email",$loginId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $user=null;
        if($result && $row = $stmt->fetch()){
            $id = $row["id"];
            $name = $row["name"];
            $passwd = $row["pass"];
            $email = $row["email"];

            $user = new User();
            $user->setId($id);
            $user->setName($name);
            $user->setPasswd($passwd);
            $user->setEmail($email);
        }
        return $user;
    }
    /**
     * ユーザー情報新規登録
     * @param User $user 登録情報が格納されたDeptオブジェクト
     * return ubteder 登録情報の連番主キーの値。登録に失敗した場合は-1。
     */
    public function insert(User $user): int{
        $sqlInsert = "INSERT INTO users (name,email,pass) VALUES (:name,:email,:password)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt ->bindValue(":name",$user->getName(),PDO::PARAM_STR);
        $stmt ->bindValue(":email",$user->getEmail(),PDO::PARAM_STR);
        $stmt ->bindValue(":password",$user->getPasswd(),PDO::PARAM_STR);
        $result = $stmt ->execute();
        //登録確認処理
        if($result){
        //登録が成功した場合

            $dpId = $this->db->lastInsertId();
        }else{
        //登録失敗なのでマイナスを返す
            $dpId = -1;
        }
        return $dpId;
    } 
   /*
        ユーザーID検索
    */
    public function findByUserNo(string $loginEmail):?User{
        $sql = "SELECT * FROM users WHERE email = :user_email";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user_email",$loginEmail,PDO::PARAM_INT);
        $result = $stmt ->execute();
        $user=null;
        if($result && $row = $stmt->fetch()){
            $id = $row["id"];
            $userName = $row["name"];
            $userEmail = $row["email"];

            $user = new User();
            $user->setId($id);
            $user->setName($userName);
            $user->setEmail($userEmail);
        }
        return $user;
    }
    /*
        ユーザー更新
    */
    public function update(User $user): bool{
        $sqlUpdate = 'UPDATE users SET name = :name WHERE email = :email';
        $stmt = $this->db->prepare($sqlUpdate);
        $stmt ->bindValue(":name",$user->getName(),PDO::PARAM_STR);
        $stmt ->bindValue(":email",$user->getEmail(),PDO::PARAM_STR);
        $result = $stmt ->execute();
        return $result;
    }
}



?>