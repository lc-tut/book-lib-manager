<?php
/*このファイルはドキュメントルートからみて "../conf/DbManager.php" となるように置いて下さい*/
function getDb() {
  $dsn = 'mysql:dbname=<データベース名>; host=<DBサーバーIP もしくは localhost>';
  $usr = '<DB ユーザー名>';
  $passwd = '<DB パスワード>';

  try {
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('SET NAMES utf8');
  } catch (PDOException $e) {
    die("接続エラー：{$e->getMessage()}");
  }
  return $db;
}
try{
     $db = getDb();
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   }catch(PDOException $Exception){
     die('接続エラー：' .$Exception->getMessage());
}


function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function br(){
  echo nl2br("\n");
}

?>