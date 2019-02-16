<?php
session_start();
//header('Location: chat.php');
/*
if (!empty($_POST['get_boardDB'])) {
	get_boardDB();
}
*/
// 投稿内容を登録
if(isset($_POST["send"]) &&$_POST["send"] == "regist") {
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
    //投稿時でなければここにくる
    /*デバッグ用
    echo'投稿失敗<br>';
    */
}
//jsでの参照時はここに来る
if (isset($_POST["jqueryid"])) {
    get_boardDB();
    /*デバッグ用
    foreach($_POST as $idx => $val){echo "$idx = $val<br>";}
    */
} else {
  /*デバッグ用
  foreach($_POST as $idx => $val){echo "$idx = $val<br>";}
  */
}

////////////////以下function
// DBからデータ(投稿内容)を取得
function get_boardDB(){
    $stmt = select();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
        // 投稿内容を表示
        //自分の投稿と他人の投稿を出し分けしたい
        if($message['name'] == $_SESSION['user_id']){
        	//自身の投稿
            echo 
            "<div id=\"self_post\">
            <p>",
            $message['time'],"：",$message['name'],"：",$message['message'],
            "</p>
            </div>";
        } else {
        	//他人の投稿
            echo 
            "<div class=\"balloon6\">
            <div class=\"faceicon\"></div>
            <div class=\"chatting\">
            <div id=\"other_post\">
            <p>",
            $message['time'],"：",$message['name'],"：",$message['message'],
            "</p>
            </div>
            </div>
            </div>
            </div>";
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
            
            $_SERVER['REQUEST_METHOD'] = 'GET';
            /*
            echo'REQUEST_METHODは'.$_SERVER['REQUEST_METHOD'];
            */
        }

    } else {
        echo'テストメッセージ：失敗<br>';
    }
}
?>