<?php
/**
 * PH34 Sample9 マスタテーブル管理完版　Src05/20
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名 = User.php
 * ディレクトリ = work3/ph34/scottadminkan/classes/entity;
 */
namespace App\Entity;

/**
 * ユーザエンティティクラス
 */
class User{
    /**
     * 主キーのid
     */
    private $id;
    /**
     * ログインID
     */
    private $email;
    /**
     * パスワード
     */
    private $passwd;
    /**
     * 性
     */
    private $name;
    /**==============================================
     * 以下のアクセサメソッド
     ================================================*/
     public function getId(): ?int{
         return $this->id;
     }
     public function setId(int $id): void{
         $this->id = $id;
     }

     public function getEmail(): ?string{
        return $this->email;
    }
    public function setEmail(string $email): void{
        $this->email = $email;
    }

    public function getPasswd(): ?string{
        return $this->passwd;
    }
    public function setPasswd(string $passwd): void{
        $this->passwd = $passwd;
    }

    public function getName(): ?string{
        return $this->name;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }

}



?>