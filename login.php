<?php

require_once('mysql_connect.php');
$pdo = connectDB();

session_start();

//DB内でPOSTされたメールアドレスを検索
try {
  $stmt = $pdo->prepare('select * from moechat where username = ?');
  $stmt->execute([$_POST['username']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//emailがDB内に存在しているか確認
if (!isset($row['username'])) {
  echo "<script>alert('ユーザーネーム又はパスワードが間違っています。');</script>";
  include 'index.html';
  exit();
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if($_POST['password'] == $row['password']){
  $_SESSION['user_id']=$row['id'];
  header('Location: main.html');
    exit();
} else {
  echo "<script>alert('ユーザーネーム又はパスワードが間違っています。');</script>";
  include 'index.html';
  exit();
  return false;
}