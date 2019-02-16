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
    <div><button id="send" name="send" value="regist" type="submit">送信</button></div>
    <div id="chat">チャット履歴</div>
</form>


<div class="chat_main">
    <script>
        $(function() {
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
                    $(".chat_main").html(data);
                });
            },1000);
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
        /*
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
<!--いったんコメントアウト-->
</div><!--chat_main-->
</body>
</html>