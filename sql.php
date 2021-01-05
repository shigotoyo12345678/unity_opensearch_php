<?php

require_once('dbconnect.php');
$pdo = connectDB();

//POSTうけとり
$prefecture = $_POST["prefecture"];   //県
$city = $_POST["city"];               //市
$shopName = $_POST["name"];           //店名
$url = $_POST["url"];                 //URL
$post = $_POST["post"];               //郵便番号
$addr11 = $_POST["address"];          //住所
$tel = $_POST["tel"];                 //電話番号
$e = $_POST["open1"];                 //特別開店時間（平日）
$f = $_POST["close1"];                //特別閉店時間（平日）
$g = $_POST["open2"];                 //特別開店時間（土日祝）
$h = $_POST["close2"];                //特別閉店時間（土日祝）
$start = $_POST["start"];             //特別営業時間適用開始日時
$end = $_POST["end"];                 //特別営業時間適用終了日時
//一時閉店
if (isset($_SESS_POSTION["close"])) {
    $close = 1;
} else {
    $close = 0;
}
$remarks = $_POST["remark"];          //備考
$tag = $_POST["tag"];                 //タグ
if (isset($_POST["image"])) {
    $image = $_POST["image"];         //画像
} else {
    $image = "";
}

$sql = "INSERT INTO `content`(`prefecture`, `city`,`name`, `url`, `post`, `address`, `tel`, `5`, `6`, `7`, `8`, `start`, `end`, `closeflg`, `remark`, `tag`) 
VALUES ('" . $prefecture . "','" . $city . "','" . $shopName . "','" . $url . "','" . $post . "','" . $addr11 . "','" . $tel . "','" . $e . "','" . $f . "','" . $g . "','" . $h . "','" . $start . "','" . $end . "',$close,'" . $remarks . "','" . $tag . "')";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);
    $yesno = "登録しました";
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $yesno = "登録できませんでした";
}
$pdo = null;    //DB切断

echo $yesno;
