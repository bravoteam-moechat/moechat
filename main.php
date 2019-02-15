<?php
setcookie("name",123);

//ユーザー情報
$user_usericon_url = 'http://www.geocities.jp/masatohappys/kumotennsi/hamugaku.png';
$user_username = 'ハムちゃん';
$user_userid = '@hamuchan86';
/*
//ルーム情報
$room_count = 5;
$room_roomurl[]
$room_hosticon_url[]
$room_hostname[]
$room_hostid[]
$room_hostroom_url[]
$room_title[]
$room_comment[]
$room_video_url[]

for($i=0; $i<5; $i++){
*/
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
		ヘッダーだよ
<?php
var_dump($_COOKIE['name']);
echo '<br>'.$_COOKIE['name'];

session_start();
$_SESSION['username'] = 'hamuko';
echo $_SESSION['username'];
?>
	</div>

	<div class="hypermainbrock"><!-- 親の親ブロック -->
		<div class="supermainbrock"><!-- 親ブロック -->
			<div class="sidebrock"><!-- サイドのブロック -->
				<div class="userbrock"><!-- メインコンテンツのブロック -->
		 			<a class="title">ユーザー</a>
		 			<?php
		 				echo '<img src="';
		 				echo $user_usericon_url;
		 				echo '" class="usericon">';
		 				echo '<p>';
		 				echo $user_username;
		 				echo '<br>';
		 				echo $user_userid;
		 				echo '</p>';
		 			?>
		 			<!--<img src="http://www.geocities.jp/masatohappys/kumotennsi/hamugaku.png" class="usericon">
		 			<p>ハムちゃん<br>@hamuchan86</p>-->
		 			<a href="mypage.php">
						<div class="mypagebutton"><!-- Myページボタン -->
				 			<p class="title">Myページ</p>
				 		</div>
			 		</a>
		 			<a href="top-page">
						<div class="logoutbutton"><!-- ログアウトボタン -->
				 			<p class="title">ログアウト</p>
				 		</div>
			 		</a>
		 		</div>

		 		<a href="make-room.html">
			 		<div class="createroombutton"><!-- ルーム新規作成ボタン -->
			 			<p class="title">ルーム新規作成</p>
			 		</div>
		 		</a>
				サイドだよ
			</div><!--
		 --><div class="mainbrock"><!-- メインのブロック -->
		 		<div class="maincontents"><!-- メインコンテンツのブロック -->
		 			<a class="title">ルーム一覧</a>
		 		</div>
		 		<div class="maincontents"><!-- メインコンテンツ(検索)のブロック -->
		 			<div class="searchbrock">
		 				<form>
			 				<div class="searchbar">
			 					<input type="text" name="seachword" size="30" placeholder="検索" class="searchtext">
			 					<input type="submit" value="" class="searchbutton">
							</div>
						</form>
					</div>
<?php
for($i = 0; $i < 5; $i++){
?>
			 		<div class="maincontents"><!-- メインコンテンツのブロック -->
			 			<div class="roombrock1">
			 				<img src="http://www.geocities.jp/masatohappys/kumotennsi/hamugaku.png" class="roomicon">
			 				<p>ハムちゃん<br>@hamuchan86</p>
			 			</div>
			 			<div class="roombrock2">
			 				<p class=roomtitle>ハムの英会話教室<p>
			 				<p>なんでも教えます。</p>

<iframe width="280" height="157" src="https://www.youtube.com/embed/yO11hngsKcs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

			 				<a href="room.php">
			 					<div class="inroombutton">入室する</div>
			 				</a>
			 				<div style="height: 10px;"></div>
			 			</div>
			 		</div>
<?php
}
?>
		 			<div style="height: 400px;"></div>
		 		</div>
				メインだよ
			</div>
		</div>
	</div>

</body>
</html>