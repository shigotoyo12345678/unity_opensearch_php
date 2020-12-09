<?php

require_once('dbconnect.php');
$pdo = connectDB();

//POSTうけとり
$content_no = $_POST["content_no"]; //施設ナンバー
$prefecture = $_POST["prefecture"]; //県
$city = $_POST["city"];             //市
//$industry = $_SESSION["industry"];     //業種
$shopName = $_POST["name"];     //店名
$url = $_POST["url"];               //URL
$post = $_POST["post"];             //郵便番号
$addr11 = $_POST["address"];         //住所
$tel = $_POST["tel"];               //電話番号
$e = $_POST["open1"];             //特別開店時間（平日）
$f = $_POST["close1"];            //特別閉店時間（平日）
$g = $_POST["open2"];              //特別開店時間（土日祝）
$h = $_POST["close2"];          //特別閉店時間（土日祝）
$start = $_POST["start"];           //特別営業時間適用開始日時
$end = $_POST["end"];               //特別営業時間適用終了日時
$close = $_POST["close"];          //一時閉店
$remarks = $_POST["remark"];       //備考
$tag = $_POST["tag"];               //タグ
if (isset($_POST["image"])) {
    $image = $_POST["image"];           //画像
} else {
    $image = "";
}

$sql = "UPDATE `content` SET `prefecture`='" . $prefecture . "',`city`='" . $city . "',`name`='" . $shopName . "',`url`='" . $url . "',`post`='" . $post . "',`address`='" . $addr11 . "',`tel`='" . $tel . "',`5`='" . $e . "',`6`='" . $f . "',`7`='" . $g . "',`8`='" . $h . "',`start`='" . $start . "',`end`='" . $end . "',`closeflg`=$close,`remark`='" . $remarks . "',`tag`='" . $tag . "' WHERE `content_no`=$content_no";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);
    $yesno = "変更しました";
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $yesno = "変更できませんでした";
}
$pdo = null;    //DB切断

echo $sql . $yesno;
