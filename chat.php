<?php
session_start();
$_SESSION['user_id'] = "マイトガイ";
require_once('chat_db_function.php')
?>

<!DOCTYPE html5>
<html lang="ja">
<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/chat.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
    <script type="text/javascript">
        var fun = function get_boardDB_php() {
            var adapter = ADP.createAdapter("chat_db_function.php");
            adapter.exec("get_boardDB");
            alert(Date.now());
        }
        //関数hyoji()を1000ミリ秒間隔で呼び出す
        setInterval("fun",1000);
    </script>
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