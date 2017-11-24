<?php
  require_once 'DbManager.php';
  try{
  
    $db = getDb();
  
    $stt = $db->prepare('INSERT INTO books(ISBN, title, author, publisher, genre)VALUES(:ISBN, :title, :author, :publisher, :genre)');
  
    $stt -> bindValue(':ISBN', $_POST['ISBN']);
    $stt -> bindValue(':title', $_POST['title']);
    $stt -> bindValue(':author', $_POST['author']);
    $stt -> bindValue(':illust', $_POST['illust']);
    $stt -> bindValue(':publisher', $_POST['publisher']);
    $stt -> bindValue(':genre', $_POST['genre']);
  
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
