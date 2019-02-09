<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>チャット</title>
</head>
 
<body>
     
<h1>チャット</h1>

<form method="post" action="chat.php">
        名前　　　　<input type="text" name="name">
        メッセージ　<input type="text" name="message">
 
        <button name="send" type="submit">送信</button>
 
        チャット履歴
    </form>
 
 
 
</body>
<section>
<?php
            // DBからデータ(投稿内容)を取得 
            $stmt = select(); foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
                // 投稿内容を表示
                echo'main0';

                echo $message['time'],"：　",$message['name'],"：",$message['message'];
                echo nl2br("\n");
            }
 
            // 投稿内容を登録
            if(isset($_POST["send"])) {
                echo'$post[send]はとれてる';
                insert();
                // 投稿した内容を表示
                $stmt = select_new();
                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
                    
                    echo $message['time'],"：　",$message['name'],"：",$message['message'];
                    echo nl2br("\n");
                }
            } else {
                echo'投稿失敗';
            }
 
            // DB接続
            function connectDB() {
                $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=uehararyuma_dbfirst';
                $user = 'uehararyuma_1';
                $password = '5626jmaM';
                $dbh = new PDO($dsn,$user,$password);
                return $dbh;
            }
 
            // DBから投稿内容を取得
            function select() {
                $dbh = connectDB();
                $sql = "SELECT * FROM message ORDER BY time";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                echo'select';
                return $stmt;
            }
 
            // DBから投稿内容を取得(最新の1件)
            function select_new() {
                $dbh = connectDB();
                $sql = "SELECT * FROM message ORDER BY time desc limit 1";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                echo'select_new';
                return $stmt;
            }
 
            // DBから投稿内容を登録
            function insert() {
                echo "insertにはいったよ<br>";
                $dbh = connectDB();
                $sql = "INSERT INTO message (id,name, message, time) VALUES (null,:name, :message, now())";
                $stmt = $dbh->prepare($sql);
                var_dump($sql);
                $params = array(':name'=>$_POST['name'], ':message'=>$_POST['message']);
                if($stmt->execute($params)){
                    echo'seikou<br>';
                } else {
                    echo'sippai<br>';
                }

            }
?>
</section>
</html>