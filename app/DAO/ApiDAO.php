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
// use Symfony\Component\VarDumper\VarDumper;

/**
 * usersテーブルへのデータ操作クラス
 */
class ApiDAO{
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
     * ベースカテゴリ検索API
     * 
     * @return array 全部門情報が格納された連想配列。キーは部門番号、値はDeptエンティティオブジェクト。
     */
    public function findAll(): bool{
        header('Content-type:application/xml: charset=UTF-8');
        $sql = "SELECT * FROM category";
        $stmt = $this->db->prepare($sql);
        $result = $stmt ->execute();
        $i=0;
        $cateBaseList=array();

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $result["category_id"];
            $name = $result["category_name"];
            $base = $result["base_id"];
            $cateBaseList[$i]["id"] = $id;
            $cateBaseList[$i]["name"] = $name;
            $cateBaseList[$i]["base"] = $base;
            $i++;
        }
        $cateBaseList = json_encode($cateBaseList);
        echo $cateBaseList;
        return true;
    }

    /**
     * ID再検索API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiSearchItemId(int $categoryId): array{
        $sql = "SELECT * FROM item WHERE category_id = :categoryId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":categoryId",$categoryId,PDO::PARAM_INT);
        $result = $stmt->execute();
        // $i=0;
        $itemList=array();

        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $name = $row["item_name"];
            $price = $row["price"];

            $item = new Item();
            $item->setItemId($id);
            $item->setItemName($name);
            $item->setPrice($price);
            $itemList[]=$item;
        }
        // dd($itemList);
        return $itemList;
    }
    /**
     * レシピID再検索API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiSearchCocktailId(int $cocktailId): array{
        $sql = "SELECT * FROM recipe_items JOIN recipe ON recipe_items.recipe_id = recipe.recipe_id WHERE item_id = :cocktailId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":cocktailId",$cocktailId,PDO::PARAM_INT);
        $result = $stmt->execute();
        // $i=0;
        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $recipe_id = $row["recipe_id"];
            $recipe_name = $row["recipe_name"];

            $recipe = new Recipe();
            $recipe->setItemId($id);
            $recipe->setRecipeId($recipe_id);
            $recipe->setRecipeName($recipe_name);
            $recipeList[]=$recipe;
        }
        // dd($recipeList);
        return $recipeList;
    }
    /**
     * レシピID再検索API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiRecipeItemId(int $recipeId): array{
        $sql = "SELECT * FROM recipe_items JOIN item ON recipe_items.item_id = item.item_id WHERE recipe_items.recipe_id = :recipeId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":recipeId",$recipeId,PDO::PARAM_INT);
        $result = $stmt->execute();
        // $i=0;
        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $recipe_id = $row["recipe_id"];
            $item_name = $row["item_name"];

            $recipe = new Item();
            $recipe->setItemId($id);
            $recipe->setRecipeId($recipe_id);
            $recipe->setItemName($item_name);
            $recipeList[]=$recipe;
        }
        // dd($recipeList);
        return $recipeList;
    }
    /**
     * Good追加API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
   public function apiGoodCocktail(int $id,int $user_id): int{
        $time = Carbon::now('Asia/Tokyo');

        // dd($id);
        $sqlInsert = "INSERT INTO favorite (user_id,item_id,time) VALUES (:user,:cocktail,:time)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt ->bindValue(":user",$user_id);
        $stmt ->bindValue(":cocktail",$id);
        $stmt ->bindValue(":time",$time);
        $result = $stmt ->execute();
        //登録確認処理
        if($result){
        //登録が成功した場合
            $dpId = $this->db->lastInsertId();
        }else{
        //登録失敗なのでマイナスを返す
            $dpId = -1;
        }
       // dd($recipeList);
       return $dpId;
   }
    /**
     * Good削除API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiDeleteGoodCocktail(int $id,int $user_id): bool{
        // dd($id);
        $sql = "DELETE FROM favorite WHERE item_id=:item_id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindValue(":item_id",$id);
        $stmt -> bindValue(":user_id",$user_id);
        $result = $stmt->execute();
        return $result;
   }
    /**
     * GoodGetAPI
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetGoodFlg(int $id,int $user_id): bool{
        // dd($id);
        $sql = "SELECT * FROM favorite WHERE item_id = :cocktail AND user_id = :user";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $stmt ->bindValue(":cocktail",$id);
        $result = $stmt ->execute();

        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // お気に入り済み
            $flg = true;
        }else{
            // お気に入り未
            $flg = false;
        }
       return $flg;
   }

       /**
     * カート追加API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiKurtItem(int $id,int $user_id): int{
        $time = Carbon::now('Asia/Tokyo');
        // dd($id);
        $sqlInsert = "INSERT INTO kurt (user_id,item_id,time) VALUES (:user,:item,:time)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt ->bindValue(":user",$user_id);
        $stmt ->bindValue(":item",$id);
        $stmt ->bindValue(":time",$time);
        $result = $stmt ->execute();
        //登録確認処理
        if($result){
        //登録が成功した場合
            $dpId = $this->db->lastInsertId();
        }else{
        //登録失敗なのでマイナスを返す
            $dpId = -1;
        }
       // dd($recipeList);
       return $dpId;
   }
    /**
     * カート削除API
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiDeleteKurtItem(int $id,int $user_id): bool{
        // dd($id);
        $sql = "DELETE FROM kurt WHERE item_id=:item_id AND user_id = :user_id AND purchase_flg = 0";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindValue(":item_id",$id);
        $stmt -> bindValue(":user_id",$user_id);
        $result = $stmt->execute();
        return $result;
   }
    /**
     * カートアイテムGetAPI
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetKurtFlg(int $id,int $user_id): bool{
        // dd($id);
        $sql = "SELECT * FROM kurt WHERE item_id = :item AND user_id = :user AND purchase_flg = 0";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $stmt ->bindValue(":item",$id);
        $result = $stmt ->execute();

        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // お気に入り済み
            $flg = true;
        }else{
            // お気に入り未
            $flg = false;
        }
       return $flg;
   }
    /**
     * 購入するAPI
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetKurtPurchase(int $user_id): bool{
        $time = Carbon::now('Asia/Tokyo');

        $sql = 'UPDATE kurt SET purchase_flg = 1 , purchase_time = :time WHERE user_id = :user AND purchase_flg = 0';
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $stmt ->bindValue(":time",$time);
        $result = $stmt ->execute();
        dd($stmt->fetch(PDO::FETCH_ASSOC));
        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // お気に入り済み
            $flg = true;
        }else{
            // お気に入り未
            $flg = false;
        }
       return $flg;
   }
    /**
     * カートリスト取得
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetKurtList(int $user_id): array{
        // dd($id);
        $sql = "SELECT * FROM kurt JOIN item ON kurt.item_id = item.item_id WHERE user_id = :user AND purchase_flg = 0";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $result = $stmt ->execute();

        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $name = $row["item_name"];
            $price = $row["price"];
            $quantity = $row["quantity"];
            $alcohol = $row["alcohol"];

            $recipe = new Item();
            $recipe->setItemId($id);
            $recipe->setItemName($name);
            $recipe->setPrice($price);
            $recipe->setQuantity($quantity);
            $recipe->setAlcohol($alcohol);
            $recipeList[]=$recipe;
        }
       return $recipeList;
   }
       /**
     * お気に入りリスト取得
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetGoodList(int $user_id): array{
        // dd($id);
        $sql = "SELECT * FROM favorite JOIN recipe ON favorite.item_id = recipe.recipe_id WHERE user_id = :user";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $result = $stmt ->execute();

        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $name = $row["recipe_name"];
            $time = $row["time"];

            $recipe = new Item();
            $recipe->setItemId($id);
            $recipe->setItemName($name);
            $recipe->setTime($time);
            $recipeList[]=$recipe;
        }
       return $recipeList;
   }
    /**
     * 閲覧履歴リスト取得
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetViewList(int $user_id): array{
        // dd($id);
        $sql = "SELECT * FROM history JOIN recipe ON history.item_id = recipe.recipe_id WHERE user_id = :user ";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $result = $stmt ->execute();
        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $name = $row["recipe_name"];
            $time = $row["time"];

            $recipe = new Item();
            $recipe->setItemId($id);
            $recipe->setItemName($name);
            $recipe->setTime($time);
            $recipeList[]=$recipe;
        }
       return $recipeList;
   }
    /**
     * 過去の購入履歴表示
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function apiGetReKurtList(int $user_id): array{
        // dd($id);
        $sql = "SELECT * FROM kurt JOIN item ON item.item_id = kurt.item_id WHERE user_id = :user AND purchase_flg = 1";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":user",$user_id);
        $result = $stmt ->execute();
        $recipeList=array();
        while($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row["item_id"];
            $name = $row["item_name"];
            $purchase_time = $row["purchase_time"];

            $recipe = new Item();
            $recipe->setItemId($id);
            $recipe->setItemName($name);
            $recipe->setPurchaseTime($purchase_time);
            $recipeList[]=$recipe;
        }
        // dd($recipeList);

       return $recipeList;
   }


}



?>