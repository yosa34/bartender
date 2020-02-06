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
class Recipe{
    // 商品ID
    private $recipe_id;
    // 商品名
    private $recipe_name;
    // 詳細
    private $recipe_info;
    // アイテムID
    private $item_id;


    /**==============================================
     * 以下のアクセサメソッド
     ================================================*/
     public function getRecipeId(): ?int{
         return $this->recipe_id;
     }
     public function setRecipeId(int $recipe_id): void{
         $this->recipe_id = $recipe_id;
     }
     public function getRecipeName(): ?string{
        return $this->recipe_name;
    }
    public function setRecipeName(string $recipe_name): void{
        $this->recipe_name = $recipe_name;
    }

    public function getRecipeInfo(): ?string{
        return $this->recipe_info;
    }
    public function setRecipeInfo(string $recipe_info): void{
        $this->recipe_info = $recipe_info;
    }
    public function getItemId(): ?int{
        return $this->item_id;
    }
    public function setItemId(int $item_id): void{
        $this->item_id = $item_id;
    }
}



?>