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
class Item{
    // 商品ID
    private $item_id;
    // 商品名
    private $item_name;
    // 詳細
    private $item_info;
    // メーカーID
    private $maker_id;
    // メーカーName
    private $maker_name;
    // アルコール度数
    private $alcohol;
    // 容量
    private $quantity;
    // カテゴリーID
    private $category_id;
    // カテゴリーID
    private $category_name;
    // 価格
    private $price;
    // 価格
    private $tiem;
    private $purchase_time;
    // 商品ID
    private $recipe_id;



    /**==============================================
     * 以下のアクセサメソッド
     ================================================*/
     public function getItemId(): ?int{
         return $this->item_id;
     }
     public function setItemId(int $item_id): void{
         $this->item_id = $item_id;
     }

     public function getItemName(): ?string{
        return $this->item_name;
    }
    public function setItemName(string $item_name): void{
        $this->item_name = $item_name;
    }

    public function getItemInfo(): ?string{
        return $this->item_info;
    }
    public function setItemInfo(string $item_info): void{
        $this->item_info = $item_info;
    }

    public function getItemMakerId(): ?int{
        return $this->maker_id;
    }
    public function setItemMakerId(string $maker_id): void{
        $this->maker_id = $maker_id;
    }

    public function getItemMakerName(): ?string{
        return $this->maker_name;
    }
    public function setItemMakerName(string $maker_name): void{
        $this->maker_name = $maker_name;
    }

    public function getAlcohol(): ?string{
        return $this->alcohol;
    }
    public function setAlcohol(string $alcohol): void{
        $this->alcohol = $alcohol;
    }

    public function getQuantity(): ?string{
        return $this->quantity;
    }
    public function setQuantity(string $quantity): void{
        $this->quantity = $quantity;
    }

    public function getCategoryId(): ?string{
        return $this->category_id;
    }
    public function setCategoryId(string $category_id): void{
        $this->category_id = $category_id;
    }

    public function getCategoryName(): ?string{
        return $this->category_name;
    }
    public function setCategoryName(string $category_name): void{
        $this->category_name = $category_name;
    }

    public function getPrice(): ?string{
        return $this->price;
    }
    public function setPrice(string $price): void{
        $this->price = $price;
    }

    public function getTime(): ?string{
        return $this->time;
    }
    public function setTime(string $time): void{
        $this->time = $time;
    }

    public function getPurchaseTime(): ?string{
        return $this->purchase_time;
    }
    public function setPurchaseTime(string $purchase_time): void{
        $this->purchase_time = $purchase_time;
    }
    public function getRecipeId(): ?int{
        return $this->recipe_id;
    }
    public function setRecipeId(int $recipe_id): void{
        $this->recipe_id = $recipe_id;
    }
}



?>