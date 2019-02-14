<?php
session_start();
$_SESSION['user_id'] = "マイトガイ";
?>

<!DOCTYPE html5>
<html lang="ja">
<head>
    <link rel="stylesheet" type="text/css" href="./css/chat.css" />
  <meta charset="utf-8">
  <title>チャット</title>
</head>

<body>
<h1>チャット</h1>

<form method="post" action="chat.php">
    <div>名前<input type="text" name="name"></div>
    <div>メッセージ<input type="text" name="message"></div>
    <div><button name="send" type="submit">送信</button></div>
    <div id="chat">チャット履歴</div>
</form>
</body>
<div class="chat_main">

<?php
    //投稿内容取得＆表示
    get_boardDB();

    // 投稿内容を登録
    if(isset($_POST["send"])) {
        $_SERVER['REQUEST_METHOD'] == 'GET';
        insert();
        /*
        // 投稿した内容を表示
        $stmt = select_new();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
            //自分の投稿と他人の投稿を出し分けしたい
            if($message['name'] == $_SESSION['user_id']){
                echo "<div id=\"self_post\">",$message['time'],"：",$message['name'],"：",$message['message'],"</div>";
            } else {
                echo "<div id=\"self_post\">",$message['time'],"：",$message['name'],"：",$message['message'],"</div>";
            }
        }
        */
    } else {
        echo'投稿失敗<br>';
    }
?>

</div>
</html>

<?php
////////////////以下function
// DBからデータ(投稿内容)を取得
function get_boardDB(){
    $stmt = select();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
        // 投稿内容を表示
        //自分の投稿と他人の投稿を出し分けしたい
        if($message['name'] == $_SESSION['user_id']){
            echo "<div id=\"self_post\">",$message['time'],"：",$message['name'],"：",$message['message'],"</div>";
        } else {
            echo "<div id=\"other_post\">",$message['time'],"：",$message['name'],"：",$message['message'],"</div>";
        }
    }
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
    return $stmt;
}

// DBから投稿内容を取得(最新の1件)
function select_new() {
    $dbh = connectDB();
    $sql = "SELECT * FROM message ORDER BY time desc limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    echo'最新の投稿=>';
    return $stmt;
}

// DBから投稿内容を登録
function insert() {
    $dbh = connectDB();
    $sql = "INSERT INTO message (id,name, message, time) VALUES (null,:name, :message, now())";
    $stmt = $dbh->prepare($sql);
    $params = array(':name'=>$_POST['name'], ':message'=>$_POST['message']);
    if($stmt->execute($params)){
        /*
        postなら処理を実行する
            old =>このページにgetでリダイレクトする
            new =>REQUEST_METHODをGETに変える
        F5更新時の二重投稿対策
        */
        if($_SERVER['REQUEST_METHOD']==='POST'){
            /*
            $this_url = 'http://uehararyuma.php.xdomain.jp/chat/chat.php';
            header($this_url);
            */
            /*
            $_SERVER['REQUEST_METHOD'] == 'GET';
            */
        }
    } else {
        echo'テストメッセージ：失敗<br>';
    }
}
?>