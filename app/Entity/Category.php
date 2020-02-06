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
class Category{
    /**
     * id
     */
    private $cate_id;
    /**
     * 名前
     */
    private $cate_name;

    /**==============================================
     * 以下のアクセサメソッド
     ================================================*/
     public function getId(): ?int{
         return $this->cate_id;
     }
     public function setId(int $cate_id): void{
         $this->cate_id = $cate_id;
     }

     public function getName(): ?string{
        return $this->cate_name;
    }
    public function setName(string $cate_name): void{
        $this->cate_name = $cate_name;
    }

}



?>