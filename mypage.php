<?php session_start();?>
<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>ユーザーマイページ</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" href="mypage.css">

<style>
	@import url('https://fonts.googleapis.com/css?family=Noto+Sans+JP');
	body {
		background-image: url(./mypage_image/back_A.png);
	}
</style>
</head>

<body>
<?php

require_once('mysql_connect.php');
$pdo = connectDB();

//セッションID取得
$id = $_SESSION['user_id'];
$name;
$username;
$pass;
$sex;
$birthday;
$point;

//パスワードをマスク
$pass_mask = str_pad("*********", strlen($pass), "*");

try {//ユーザー情報取得
    $query = "SELECT * FROM moechat WHERE ID = :id";
    $stmt = $pdo->prepare($query);
    $palam = array(':id'=>$id);
	$stmt->execute($palam);
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

//DBから取得したユーザー情報を変数に代入
foreach ($result as $row){
    $id = $row['id'];
    $name = $row['name'];
    $username = $row['username'];
    $pass = $row['password'];
    $sex = $row['sex'];
    $birthday = $row['birthday'];
    $point = $row['point'];
}
?>

<SCRIPT language="JavaScript">
    //ユーザー情報変更確認アラート
    function msgdsp() {
        var result = window.confirm("登録変更します");
        if( result ) {
    		location.href = "mypage.php";
		}
    }
    //課金確認アラート
    function moneydsp() {
        var result = window.confirm("課金してハッピーになろう！");
        if( result ) {
    		location.href = "https://www.paypal.com/";
		}
   }

</SCRIPT>

<!--画面上部-->
<div class="container">

<!--左（メインページへのリンク）-->
	<div class="box1">
		<a href="main.html">
			<IMG src="mypage_image/logo.png" alt="メインページへ" width="90px" height="70px"/>
		</a>
	</div>

<!--右（ログアウト）-->
	<div class="box2">
		<a href="index.html">
			<IMG src="mypage_image/logout.png" alt="メインページへ" width="100px" />
		</a>
	</div>

</div><!--container1-->

<!--画面中部-->
<div class="container" style="padding-left: 180px;">

	<!--左（アイコン画像）-->
	<div class="box3">
		<button type="reset" >
			<IMG src="mypage_image/camera_icon.png"/>
		</button>
	</div>

	<!--右（ユーザー情報）-->
	<div class="box4">
		<table>
			<tr>
				<td>ID</td>
				<td><?php print($id);?></td>
			</tr>
			<tr>
				<td>名前</td>
				<td><?php print($name);?></td>
				<td>
					<input type='submit' value='変更' onclick="msgdsp()">
				</td>
			</tr>
			<tr>
				<th>ユーザー名</th>
				<td><?php print($username);?></td>
				<td>
					<input type='submit' value='変更' onclick="msgdsp()">
				</td>
			</tr>
			<tr>
				<td>PASS</td>
				<td><?php print($pass_mask);?></td>
				<td>
					<input type="button" value="変更" onclick="msgdsp()">
				</td>
			</tr>
			<tr>
				<td>性別</td>
				<td><?php print($sex);?></td>
			</tr>
			<tr>
				<td>生年月日</td>
				<td><?php print($birthday);?></td>
			</tr>
			<tr>
				<td>ポイント</td>
				<td><?php print($point);?></td>
				<td>
					<input type="button" value="課金" onclick="moneydsp()">
				</td>
			</tr>
		</table>
	</div>
</div><!--container2-->

<!--フッター-->
<footer>
	<p>&copy; 2019 team Bravo Inc.</p>
</footer>
</body>
</html>