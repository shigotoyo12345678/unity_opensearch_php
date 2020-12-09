<?php

require_once('dbconnect.php');
$pdo = connectDB();

$prefecture = $_POST["prefecture"];
$city = $_POST["city"];
$word1 = $_POST["word1"];
$word2 = "";
if ($_POST["word2"] != "") {
    $word2 = $_POST["word2"];
}

$now = $_POST["now"];

$sql = "SELECT * FROM `content` WHERE 1";

if ($prefecture != "") {
    $sql = $sql . " AND `prefecture`='" . $prefecture . "'";
}
if ($city != "") {
    $sql = $sql . " AND `city`='" . $city . "'";
}
if ($word1 != "") {
    $sql = $sql . " AND( `prefecture` LIKE '%" . $word1 . "%' OR `city` LIKE '%" . $word1 . "%' 
            OR `name` LIKE '%" . $word1 . "%' OR `address` LIKE '%" . $word1 . "%' OR `remark` LIKE '%" . $word1 . "%' OR `tag` LIKE '%" . $word1 . "%' )";
}
if ($word2 != "") {
    $sql = $sql . " AND `prefecture` LIKE '%" . $word2 . "%' OR `city` LIKE '%" . $word2 . "%' 
            OR `name` LIKE '%" . $word2 . "%' OR `address` LIKE '%" . $word2 . "%' OR `remark` LIKE '%" . $word2 . "%' OR `tag` LIKE '%" . $word2 . "%'";
}
if ($now == 1) {
    $today = date("Y-m-d");
    $youbi = date("w", strtotime($today));

    if ($youbi == 1 || $youbi == 2 || $youbi == 3 || $youbi == 4 || $youbi == 5) {
        $num = 1;
    } else if ($youbi == 0 || $youbi == 6) {
        $num = 0;
    }
    if ($num == 1) {
        $sql = $sql . "  AND (  CURRENT_TIME >= `5` OR CURRENT_TIME <= `6` ) AND ( `5` < `6` AND CURRENT_TIME BETWEEN `5` AND `6` ) OR ( `5` > `6` AND ( CURRENT_TIME BETWEEN `5` AND '23:59:59' OR CURRENT_TIME BETWEEN '00:00:00' AND `6` ) ) OR ( `5` = '00:00:00' AND `6` = '00:00:00' ) AND ( CURRENT_DATE >= `start` AND CURRENT_DATE <= `end` ) AND `closeflg` = 0 ";
    } else if ($num == 0) {
        $sql = $sql . "  AND (  CURRENT_TIME >= `7` OR CURRENT_TIME <= `8` ) AND ( `7` < `8` AND CURRENT_TIME BETWEEN `7` AND `8` ) OR ( `7` > `8` AND ( CURRENT_TIME BETWEEN `7` AND '23:59:59' OR CURRENT_TIME BETWEEN '00:00:00' AND `8` ) ) OR ( `7` = '00:00:00' AND `8` = '00:00:00' ) AND ( CURRENT_DATE >= `start` AND CURRENT_DATE <= `end` ) AND `closeflg` = 0 ";
    }
}




try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $aaa = 0;
    $hoge = array();
    $hoge2 = array("button" => $hoge);

    // 取得したデータを出力
    foreach ($stmt as $value) {
        $aaa += 1;
        array_push($hoge, array("content_no" => $value["content_no"], "name" => $value["name"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

//array_push($hoge2, $hoge);
$hoge2 = array("button" => $hoge);

$hoge2 = json_encode($hoge2, JSON_UNESCAPED_UNICODE);

echo   $hoge2;
