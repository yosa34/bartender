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
use App\Entity\Item;

/**
 * usersテーブルへのデータ操作クラス
 */
class SearchDAO{
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
     * カテゴリーID検索
     * 
     * @param integer $categoryId カテゴリid.
     * return User 該当するUserオブジェクト。ただし、該当データがない場合はnull。
     */
    public function searchItemId(int $categoryId): array{
        $sql = "SELECT * FROM item WHERE category_id = :categoryId";
        $stmt = $this->db->prepare($sql);
        $stmt ->bindValue(":categoryId",$categoryId,PDO::PARAM_INT);
        $result = $stmt->execute();
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
        return $itemList;
    }


}



?>