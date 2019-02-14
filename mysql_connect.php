<?php

//PDO MySQL接続
function connectDB(){
//ユーザ名やDBアドレスの定義
    $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=kyosukesa10_data;charset=utf8';
    $username = 'kyosukesa10_moe';
    $password = '1234abcd';

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        exit('' . $e->getMessage());
    }

    return $pdo;
}
