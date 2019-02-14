<?php session_start(); ?>
<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>マイページ</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" href="mypage.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css?family=Noto+Sans+JP');
</style>
</head>

<body>

<?php

require_once('mysql_connect.php');
$pdo = connectDB();
$ID = $_SESSION['user_id'];

mysql_set_charset('utf8');

$name;
$username;
$pass;
$sex;
$birthbay;
$point;


try {
    $sql = mysql_query("SELECT * FROM moechat WHERE ID = :ID");
    $sql->bindValue(':ID', $ID, PDO::PARAM_INT);
    $result = $sql->execute();
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

foreach ($result as $row) {
    //配列に入れる
        $name = $row['name'];
        $username = $row['username'];
        $pass = $row['pass'];
        $sex = $row['sex'];
        $birthbay = $row['birthbay'];
        $point = $row['point'];
    }
?>

<form action="のちほど" method="post">
<SCRIPT language="JavaScript">
     <!--
       function msgdsp() {
           alert("登録修正します");
       }
       function moneydsp() {
           alert("課金すると幸せになります");
       }
     // -->
</SCRIPT>
<div class="container">

		<div class="box1">
			<a href="main.html">
				<IMG src="mypage_image/logo.png" alt="メインページへ" width="70px" height="60px"/>
			</a>
		</div>
		<div class="box2">
				<a href="index.html">
				<IMG src="mypage_image/logout.png" alt="メインページへ" width="100px" onclick="<?php $ID = null;?>"/>
			</a>
		</div>

</div><!--container1-->
<div class="container" style="padding-left: 180px;">
		<div class="box3">
			<iframe flameborder="0" style="position: static; display: inline-block; width: 520px; height:600px; padding: 0px; border:none; max-width: 100%; min-width: 180px; margin-top: 0px; margin-bottom: 0px; min-height: 200px;">
				<button type="reset" border="0">
					<IMG src="mypage_image/camera_icon.png"/>
				</button>
			</iframe>
		</div>
		<div class="box4">
			<table>
				<tr>
					<td>ID</td>
					<td><?php print($ID);?></td>
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
						<td><?php print($name);?></td>
					<td>
						<input type='submit' value='変更' onclick="msgdsp()">
					</td>
				</tr>
				<tr>
					<td>PASS</td>
						<td><?php print($username);?></td>
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
</form>

</body>
</html>