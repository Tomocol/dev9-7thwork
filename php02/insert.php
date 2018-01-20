<?php 
//フォームのデータ受け取り
$title = $_POST["title"];
$detail = $_POST["detail"];

//DB定義
const DB = "";
const DB_ID = "";
const DB_PW = "";
const DB_NAME = "";
session_set_save_handler星
//PDOでデータベース接続
try {
$pdo = new PDO("mysql:host=localhost;dbname=gsblog_db;charset=utf8",'root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());//うまくいかない時のメッセージ
}

// 実行したいSQL文
$sql = "INSERT INTO gs_table (id,title,detail,time)VALUES(NULL,:title,:detail,sysdate())";//ここに書いた時点では実行ボタンは押してない

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tite',$title,PDO::PARAM_STR);
$stmt->bindValue(':detail',$detail,PDO::PARAM_STR);

//実際に実行


//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
header("Location: index.php");

}

?>