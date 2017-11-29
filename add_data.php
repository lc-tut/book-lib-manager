<?php
  require_once 'DbManager.php';
  try{
  
    $db = getDb();
  
    $stt = $db->prepare('INSERT INTO books(ID, ISBN, title, author, publisher, genre)VALUES(NULL, :ISBN, :title, :author, :publisher, :genre)');
  
    $stt -> bindValue(':ISBN', $_POST['ISBN']);
    $stt -> bindValue(':title', $_POST['title']);
    $stt -> bindValue(':author', $_POST['author']);
    $stt -> bindValue(':publisher', $_POST['publisher']);
    $stt -> bindValue(':genre', $_POST['genre']);
  
    $stt -> execute();
    $db = NULL;

    $db = getDb();
    
    $isbn = $_POST['ISBN'];
    $stt = $db->prepare('CREATE TABLE `'.$isbn.'`( ID int(3) unsigned zerofill  NOT NULL AUTO_INCREMENT PRIMARY KEY, borrower varchar(10) COLLATE utf8mb4_general_ci NOT NULL, date_time datetime NOT NULL DEFAULT current_timestamp, dc varchar(6) COLLATE utf8mb4_general_ci NOT NULL ) ENGINE=InnoDB COLLATE utf8mb4_general_ci;');

    #$stt -> bindValue(':ISBN', $isbn);
    $stt -> execute();
    $db = NULL;

    $db = getDb();
  
    $stt = $db->prepare('INSERT INTO `'.$isbn."` (borrower, date_time, dc) VALUES(:name, current_timestamp(), :dc)");
    $stt -> bindValue(':name', "system");
    $stt -> bindValue(':dc', "New");
  
    $stt -> execute();
    $db = NULL;
  
  }catch(PDOException $e){
    die("error:{$e->getMessage()}");
  }
?>

<html>
  <head>
    <title>完了</title>
  </head>
  <body>
    <p>登録が完了しました。</p>
    <a href="./">リストに戻る</a>
  </body>
</html>