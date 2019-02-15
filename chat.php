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
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    -->
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
  <meta charset="utf-8">
  <title>チャット</title>
</head>

<body>
<h1>チャット</h1>

<form method="post" action="chat.php">
    <div>名前<input type="text" name="name"></div>
    <div>メッセージ<input type="text" name="message" id="message"></div>
    <div><button id="send" name="send" type="submit">送信</button></div>
    <div id="chat">チャット履歴</div>
</form>
</body>
    <script>
$(function() {

//    $("[type=button]").on("click", function() {
 setInterval(function(){
    console.log("js動いてる");
        $.post(
            //第一引数 url
            "./chat_db_function.php", 
        {
            //第二引数 送信data
            jqueryid : $("[type=text]").val()
        }, 
        //第三引数　リクエストが成功した際に実行する関数
        function(data) {
            $(".chat_main").text(data);
        });
},1000);
//    });

});

/*
        $.ajax({
  type: 'POST',
  url: './chat_db_function.php',
  dataType:'text',
  data: {
    name1 : "a"
  },
  success: function(data) {
    alert("success");
    //location.href = "./test.php";
  }
});
*/
        /*
//二重submit対策
(function () {
    $("form").on("submit", function onsubmit (event) {
        $(this).off("submit", onsubmit).on("submit", false);
    });
})();
//送信ボタン連打対策
(function () {
    $("input[type='button']").on("click", function onclick (event) {
        $(this).off("click", onclick).on("click", false);
    });
})();
//ajax
$('#send').click(function(){
jQuery(function($){
        //ajax送信
        $.ajax({
        url : "./chat_db_function.php",
        type : "POST",
        dataType:"json",
        data : {post_data_1:"hoge", post_data_2:"piyo"},
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("ajax通信に失敗しました");
        },
        success : function(response) {
            console.log("ajax通信に成功しました");
            console.log(response[0]);
            console.log(response[1]);
        }
    });
});
}
*/
    </script>
<div class="chat_main">

<?php
    //投稿内容取得＆表示
    get_boardDB();

    // 投稿内容を登録
    if(isset($_POST["send"])) {
        if(select_new() != $_POST['message'] 
        && $_POST['message'] != ""){

            insert();
            unset($_POST["send"]);
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
        }
    } else {
        echo'投稿失敗<br>';
    }
?>

</div>
</html>