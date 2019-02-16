<?php
function sessionSave(){
	$id = $_SESSION['user_id'];

	require_once('mysql_connect.php');//外部ファイルを使う
	try {
	    //データベースに接続
	    $pdo = connectDB();//外部ファイルのメソッド
	    //SQL文を用意(roomテーブルから、検索ワードと一致するチャットルーム情報を取得する)
	    $sql = "SELECT * FROM moechat WHERE ID = :id";
	    //SQL文をいったんpStmtクラス変数に入れる
	    $pStmt = $pdo->prepare($sql);
	    //変数に値を入れてSQLを実行
	    $pStmt->bindValue(':id', $id, PDO::PARAM_STR);
	    $pStmt->execute();
	    //結果
	    foreach( $pStmt as $value )
	    {
			$_SESSION['user_icon']=$value[img];//追記＠伊藤
			$_SESSION['user_name']=$row[username];//追記＠伊藤
			$_SESSION['mypage_url']='mypage.php';//追記＠伊藤
	    }
	} catch(PDOException $e) {
	    echo $e->getMessage();
	    die();
	}
}
?>