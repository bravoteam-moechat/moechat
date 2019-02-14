<?php

require_once('mysql_connect.php');
$pdo = connectDB();

session_start();
//POSTのvalidate
// if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//   echo '入力された値が不正です。';
//   return false;
// }
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
  echo 'ユーザーネーム又はパスワードが間違っています。';
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if($_POST['password'] == $row['password']){
  $_SESSION['user_id']=$row['id'];
// if (password_verify($_POST['password'], $row['password'])) {
//   session_regenerate_id(true); //session_idを新しく生成し、置き換える
//   $_SESSION['EMAIL'] = $row['email'];
  header('Location: main.html');
    exit();
} else {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}