<?php 
//フォームのデータ受け取り
$market = $_POST["market"];
$detail = $_POST["detail"];

//DB定義
const DB = "";
const DB_ID = "";
const DB_PW = "";
const DB_NAME = "";

//PDOでデータベース接続
try {
$pdo = new PDO("mysql:host=localhost;dbname=subsidy_db;charset=utf8",'root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());//うまくいかない時のメッセージ
}

// 実行したいSQL文
$sql = "INSERT INTO TABLE 1 (subsidy_id,market_id,subsidy_start_date,subsidy_expire_date,subsidy_amount,subsidy_requirement,subsidy_task,subsidy_website,subsidy_post_date,subsidy_update_date)VALUES(NULL,:market,:startdate,sysdate())";//ここに書いた時点では実行ボタンは押してない

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':market',$market,PDO::PARAM_STR);
$stmt->bindValue(':detail',$detail,PDO::PARAM_STR);

//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
header("Location: entry.php");
exit();
}

?>