<!-- セッションからユーザー情報を取得 -->
<?php
session_start();
//@Tips
//$_SESSION['username'] = 'hamuko';
//echo $_SESSION['username'];
//ユーザー情報
$user_usericon_url = 'http://www.geocities.jp/masatohappys/kumotennsi/hamugaku.png';
$user_username = 'ハムちゃん';
$user_userid = '@hamuchan86';
$user_mypage_url = 'mypage.php';
?>

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

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>MOE Chat - メインページ</title>

	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="headerbrock">
		<a href="">
			<img src="mypage_image/logo.png" class="logo">
		</a>
		ヘッダーだよ
	</div>

	<div class="hypermainbrock"><!-- 0. 親の親ブロック -->
		<div class="supermainbrock"><!-- 0. 親ブロック -->

			<div class="sidebrock"><!---------- 0. ↓サイドブロック↓ ---------->

				<div class="userbrock"><!-- 1. [ユーザー] -->
		 			<a class="title">ユーザー</a>
		 			<?php
		 				echo '<img src="'.$user_usericon_url.'" class="usericon">'."\n";
		 				echo '<p>'.$user_username.'<br>'.$user_userid.'</p>'."\n";
		 			?>
		 			<!-- 1-1. Myページボタン -->
		 			<?php echo '<a href="'.$user_mypage_url.'">'."\n"; ?>
						<div class="mypagebutton">
				 			<p class="title">Myページ</p>
				 		</div>
			 		</a>
			 		<!-- 1-2. ログアウトボタン -->
		 			<a href="top-page.html">
						<div class="logoutbutton">
				 			<p class="title">ログアウト</p>
				 		</div>
			 		</a>
		 		</div>

		 		<a href="make-room.html"><!-- 2. [ルーム新規作成] -->
			 		<div class="createroombutton"><!-- 2-1. ルーム新規作成ボタン -->
			 			<p class="title">ルーム新規作成</p>
			 		</div>
		 		</a>

				サイドだよ
			</div><!---------- 0. ↑サイドブロック↑ ----------
		 --><div class="mainbrock"><!---------- 0. ↓メインブロック↓ ---------->

		 		<div class="maincontents"><!-- 1. [ルーム一覧(タイトル)] -->
		 			<a class="title">ルーム一覧</a>
		 		</div>

		 		<div class="maincontents"><!-- 2. [ルーム一覧表示ブロック] -->
		 			<div class="searchbrock"><!-- 2-1. 検索バー -->
		 				<form action="" method="get">
			 				<div class="searchbar">
			 					<?php
			 						if(isset($_GET['keyword'])){
									    $keyword = $_GET['keyword'];
									    echo '<input type="text" name="keyword" size="30" placeholder="検索" class="searchtext" value="'.$keyword.'">';
									} else {
										echo '<input type="text" name="keyword" size="30" placeholder="検索" class="searchtext">';
									}
			 					?>
			 					<input type="submit" value="" class="searchbutton">
							</div>
						</form>
					</div>
					<?php for($i=0; $i<$roomcount; $i++){ ?>
				 		<div class="maincontents"><!-- メインコンテンツのブロック -->
				 			<div class="roombrock1">
		 						<?php
		 							echo '<img src="'.$room_hosticon_url[$i].'" class="roomicon">'."\n";
		 							echo '<p>'.$room_hostname[$i].'<br>'.$room_hostid[$i].'</p>'."\n";
		 						?>
				 			</div>
				 			<div class="roombrock2">
				 				<?php
		 							echo '<p class=roomtitle>'.$room_title[$i].'</p>'."\n";
		 							echo '<p>'.$room_comment[$i].'</p>'."\n";
		 						?>

<iframe width="280" height="157" src="https://www.youtube.com/embed/yO11hngsKcs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				 				<a href="chat.php">
				 					<div class="inroombutton">入室する</div>
				 				</a>
				 				<div style="height: 10px;"></div>
				 			</div>
				 		</div>
				 	<?php } ?>
		 			<div style="height: 400px;"></div>
		 		</div>
				メインだよ
			</div>
		</div>
	</div>

</body>
</html>