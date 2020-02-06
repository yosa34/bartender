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
use App\Entity\Item;
use App\Entity\Recipe;
use Carbon\Carbon;

/**
 * usersテーブルへのデータ操作クラス
 */
class ItemDAO{
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
     * カクテルの詳細表示
     * 
     * @param integer $itemId カクテルid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function getItemInfo(int $itemId):?Item{
        $sql = "SELECT * FROM item JOIN maker ON item.maker_id = maker.maker_id JOIN category ON item.category_id = category.category_id WHERE item_id = :itemId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":itemId",$itemId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $item=null;
        if($result && $row = $stmt->fetch()){
            $id = $row["item_id"];
            $item_name = $row["item_name"];
            $item_info = $row["item_info"];
            $maker_id = $row["maker_id"];
            $maker_name = $row["maker_name"];
            $alcohol = $row["alcohol"];
            $quantity = $row["quantity"];
            $category_id = $row["category_id"];
            $category_name = $row["category_name"];
            $price = $row["price"];

            $item = new Item();
            $item->setItemId($id);
            $item->setItemName($item_name);
            $item->setItemInfo($item_info);
            $item->setItemMakerId($maker_id);
            $item->setItemMakerName($maker_name);
            $item->setAlcohol($alcohol);
            $item->setQuantity($quantity);
            $item->setCategoryId($category_id);
            $item->setCategoryName($category_name);
            $item->setPrice($price);
        }
        return $item;
    }
    /**
     * カクテルの詳細表示
     * 
     * @param integer $itemId カクテルid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function getRecipeInfo(int $recipeId):?Recipe{
        $sql = "SELECT * FROM recipe INNER JOIN recipe_items ON recipe_items.recipe_id = recipe.recipe_id WHERE recipe.recipe_id = :recipeId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":recipeId",$recipeId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $recipe=null;
        if($result && $row = $stmt->fetch()){
            $item_id = $row["item_id"];
            $recipe_id = $row["recipe_id"];
            $recipe_name = $row["recipe_name"];
            $recipe_info = $row["recipe_info"];

            $recipe = new Recipe();
            $recipe->setItemId($item_id);
            $recipe->setRecipeId($recipe_id);
            $recipe->setRecipeName($recipe_name);
            $recipe->setRecipeInfo($recipe_info);
        }
        return $recipe;
    }
    /**
     * 回覧履歴検索
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function findByHistory(int $id,int $user_id):?Item{
        $sql = "SELECT * FROM history WHERE item_id = :item_id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":item_id",$id,PDO::PARAM_INT);
        $stmt ->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $result = $stmt->execute();
        $item=null;
        if($result && $row = $stmt->fetch()){
            $item_id = $row["item_id"];

            $item = new Item();
            $item->setItemId($item_id);
        }
        return $item;
    }

    /**
     * 回覧履歴時間更新
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function updateByHistory(int $id,int $user_id): bool{
        $time = Carbon::now('Asia/Tokyo');
        $sqlUpdate = "UPDATE history SET time = :time WHERE item_id = :item_id AND user_id = :user_id";
        $stmt = $this->db->prepare($sqlUpdate);
        $stmt ->bindValue(":item_id",$id,PDO::PARAM_INT);
        $stmt ->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $stmt ->bindValue(":time",$time);
        $result = $stmt ->execute();

        return $result;
    }

    /**
     * 回覧履歴追加
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function insertHistory(int $id,int $user_id): bool{
        $time = Carbon::now('Asia/Tokyo');
        $sqlInsert = "INSERT INTO history (item_id,user_id,time) VALUES (:item_id,:user_id,:time)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt ->bindValue(":item_id",$id,PDO::PARAM_INT);
        $stmt ->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $stmt ->bindValue(":time",$time);
        $result = $stmt->execute();

        return $result;
    }



}



?>