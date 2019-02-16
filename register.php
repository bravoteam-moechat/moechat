<?php
//require_once外部ファイルを一度だけ読み込む
require_once('mysql_connect.php');//Xampp/htdocs/testの中にあるファイルを読み込む
$pdo = connectDB();              // mysql_connect.phpのメソッドを作動させPDO（PHP DATA OBJECT）のインスタンスを戻り値で取得

// POSTうけとり
$name = $_POST["name"]; //要求されてくるname
$username = $_POST["username"]; //要求されてくるusername
$password = $_POST["password"]; //要求されてくるname
$sex = $_POST["sex"]; //要求されてくる
$birthday = $_POST["birthday"]; //要求されてくるname
// $img = $_POST["img"]; //要求されてくる
$moe_point ='500';


try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo->prepare("INSERT INTO moechat (name,username,password,sex,birthday,moe_point) VALUES (:name, :username, :password, :sex, :birthday, :moe_point)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
    $stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stmt->bindValue(':moe_point', $moe_point, PDO::PARAM_INT);
    if($stmt->execute()){
        session_start();
        // $_SESSION['ID'] = ;
    $stmt = $pdo->prepare("SELECT * FROM moechat WHERE username = :username");
    $stmt->execute(array($username));
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $data){
        $_SESSION['user_id']=$data['id'];
    }
    header('Location: main.html');
    exit();
    }else{
        echo "失敗したよ";
    }


} catch (PDOException $e) {
    var_dump($e->getMessage()); // var_dump(情報を出力する変数)
}
echo json_encode($ranking, JSON_UNESCAPED_UNICODE);