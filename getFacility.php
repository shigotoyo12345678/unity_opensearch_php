<?php

require_once('dbconnect.php');
$pdo = connectDB();

$number = $_POST["number"];

$sql = "SELECT * FROM `content` WHERE `content_no`=$number";
try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $hoge = array();
    /*$hoge2 = array("facility" => $hoge);*/

    foreach ($stmt as $value) {
        array_push($hoge, array("content_no" => $value["content_no"], "prefecture" => $value["prefecture"], "city" => $value["city"], "name" => $value["name"], "url" => $value["url"], "post" => $value["post"], "address" => $value["address"], "tel" => $value["tel"], "open1" => $value["5"], "close1" => $value["6"], "open2" => $value["7"], "close2" => $value["8"], "start" => $value["start"], "end" => $value["end"], "closeflg" => $value["closeflg"], "remark" => $value["remark"], "tag" => $value["tag"],));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

//array_push($hoge2, $hoge);
/*$hoge2 = array("facility" => $hoge);*/

$hoge = json_encode($hoge, JSON_UNESCAPED_UNICODE);

echo $hoge;
