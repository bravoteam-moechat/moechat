<!-- SQLを実行して検索結果を表示 -->
<?php
    require_once('mysql_connect.php');//外部ファイルを使う
	//URLからGETパラメータを取得
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        if(isset($_GET['offset'])){
            $offset = $_GET['offset'];
        } else {
            $offset = 0;
        }
        try {
                //データベースに接続
                $pdo = connectDB();//外部ファイルのメソッド
                //SQL文を用意(roomテーブルから、検索ワードと一致するチャットルーム情報を取得する)
                $sql = "SELECT * FROM room WHERE title like '%:keyword%' OR name like '%:keyword%' LIMIT 5 OFFSET :offset";
                //SQL文をいったんpStmtクラス変数に入れる
                $pStmt = $pdo->prepare($sql);
                //変数に値を入れてSQLを実行
                $pStmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
                $pStmt->bindValue(':offset', $offset, PDO::PARAM_STR);
                $pStmt->execute();
                //結果を配列に格納
                $roomcount = 0;
                foreach( $pStmt as $value )
                {
                    $roomcount++;
                    //ルーム一覧の情報
                    $room_hosticon_url[] = $value[hosticonurl];//ルームホストのアイコン
                    $room_hostname[] = $value[hostname];//ルームホストの名前(ハムちゃん)
                    $room_hostid[] = $value[hostid];//ルームホストのID名(@hamuchan86)
                    $room_hostroom_url[] = $value[hosturl];//ホストのマイページURL
                    $room_roomurl[] = $value[roomurl];//チャットルームのURL
                    $room_title[] = $value[title];//ルーム名
                    $room_comment[] = $value[comment];//ルーム説明欄
                }
        } catch(PDOException $e) {
                echo $e->getMessage();
                die();
        }
    } else {
        try {
                //データベースに接続
                $pdo = connectDB();//外部ファイルのメソッド
                //SQL文を用意(roomテーブルから、検索ワードと一致するチャットルーム情報を取得する)
                $sql = "SELECT * FROM room LIMIT 5 OFFSET 0";
                //SQL文をいったんpStmtクラス変数に入れる
                $pStmt = $pdo->prepare($sql);
                //SQLを実行
                $pStmt->execute();
                //結果を配列に格納
                $roomcount = 0;
                foreach( $pStmt as $value )
                {
                    $roomcount++;
                	//ルーム一覧の情報
    				$room_hosticon_url[] = $value[hosticonurl];//ルームホストのアイコン
    				$room_hostname[] = $value[hostname];//ルームホストの名前(ハムちゃん)
    				$room_hostid[] = $value[hostid];//ルームホストのID名(@hamuchan86)
    				$room_hostroom_url[] = $value[hosturl];//ホストのマイページURL
    				$room_roomurl[] = $value[roomurl];//チャットルームのURL
    				$room_title[] = $value[title];//ルーム名
    				$room_comment[] = $value[comment];//ルーム説明欄
                }
        } catch(PDOException $e) {
                echo $e->getMessage();
                die();
        }
    }
?>