<?php


//PDO MySQL接続
function connectDB()
{

    //ユーザ名やDBアドレスの定義
    $dsn = 'mysql:dbname=shigotoyo_database;host=mysql1.php.starfree.ne.jp;charset=utf8';
    $username = 'shigotoyo_1216';
    $password = 'shigotoyo1216';

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        exit('' . $e->getMessage());
    }

    return $pdo;
}
