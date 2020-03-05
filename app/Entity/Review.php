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
class Review{

    // 商品ID
    private $review_id;
    // 商品名
    private $item_id;
    // 詳細
    private $user_id;
    // アイテムID
    private $review;
    // アイテムID
    private $create_time;

    /**==============================================
     * 以下のアクセサメソッド
     ================================================*/
     public function getReviewId(): ?int{
         return $this->review_id;
     }
     public function setReviewId(int $review_id): void{
         $this->review_id = $review_id;
     }
     public function getItemId(): ?int{
        return $this->item_id;
    }
    public function setItemId(string $item_id): void{
        $this->item_id = $item_id;
    }
    public function getUserId(): ?int{
        return $this->user_id;
    }
    public function setUserId(string $user_id): void{
        $this->user_id = $user_id;
    }

    public function getReview(): ?string{
        return $this->review;
    }
    public function setReview(string $review): void{
        $this->review = $review;
    }
    public function getTime(): ?string{
        return $this->create_time;
    }
    public function setTime(string $create_time): void{
        $this->create_time = $create_time;
    }

}



?>