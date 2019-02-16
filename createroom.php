<?php
session_start();
//POSTパラメータを取得
$hosticonurl = $_SESSION['user_icon'];
$hostname = $_SESSION['user_name'];
$hostid = $_SESSION['user_id'];
$hosturl = $_SESSION['mypage_url'];
$roomurl = $_POST('POSTの変数名を入れてね');
$title = $_POST('POSTの変数名を入れてね');
$comment = $_POST('POSTの変数名を入れてね');

require_once('mysql_connect.php');//外部ファイルを使う
try {
    //データベースに接続
    $pdo = connectDB();//外部ファイルのメソッド
    //SQL文を用意(roomテーブルから、検索ワードと一致するチャットルーム情報を取得する)
    $sql = "INSERT INTO room (hosticonurl,hostname,hostid,hosturl,roomurl,title,comment) VALUES (:hosticonurl,:hostname,:hostid,:hosturl,:roomurl,:title,:comment)";
    //SQL文をいったんpStmtクラス変数に入れる
    $pStmt = $pdo->prepare($sql);
    //変数に値を入れてSQLを実行
    $pStmt->bindValue(':hosticonurl', $hosticonurl, PDO::PARAM_STR);
    $pStmt->bindValue(':hostname', $hostname, PDO::PARAM_STR);
    $pStmt->bindValue(':hostid', $hostid, PDO::PARAM_STR);
    $pStmt->bindValue(':hosturl', $hosturl, PDO::PARAM_STR);
    $pStmt->bindValue(':roomurl', $roomurl, PDO::PARAM_STR);
    $pStmt->bindValue(':title', $title, PDO::PARAM_STR);
    $pStmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $pStmt->execute();
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}
?>

<?php require('main.php'); ?>