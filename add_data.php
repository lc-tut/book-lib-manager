<?php
  require_once 'DbManager.php';
  try{
  
    if(strlen($_POST['ISBN']) != 13) throw new Exception("ISBNが正しくありません。");
    else{
  
      $stt = $db->prepare('INSERT INTO books(ISBN, title, author, publisher, genre, status, borrower)VALUES(:ISBN, :title, :author, :publisher, :genre, :status, :borrower)');
  
      $stt -> bindValue(':ISBN', $_POST['ISBN']);
      $stt -> bindValue(':title', $_POST['title']);
      $stt -> bindValue(':author', $_POST['author']);
      $stt -> bindValue(':publisher', $_POST['publisher']);
      $stt -> bindValue(':genre', $_POST['genre']);
      $stt -> bindValue(':status', "貸出可能");
      $stt -> bindValue(':borrower', "部室内書庫");
  
      $stt -> execute();
      $db = NULL;

      $db = getDb();
  
      $stt = $db->prepare('INSERT INTO history(ID, date_time, ISBN, processer, process)VALUES(NULL, NULL, :ISBN, :processer, :process)');
  
      $stt -> bindValue(':ISBN', $_POST['ISBN']);
      $stt -> bindValue(':processer', 'system');
      $stt -> bindValue(':process', '新規');
  
      $stt -> execute();
      $db = NULL;
      print "<html><head><title>処理終了</title></head><body><p>登録が完了しました。</p><a href=\"./\">リスト戻る</a></body></html>";
    }
  }catch(Exception $e){
      echo("<html><head><title>エラー</title></head><body><p>登録に失敗しました。エラーを確認して下さい。</p><a href=\"./input.html\">登録画面に戻る</a></body></html>");
    die("error:{$e->getMessage()}");
  }
?>