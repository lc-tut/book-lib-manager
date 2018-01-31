<?php
  require_once 'DbManager.php';
  require_once 'FelicaReader.php';
  try{
    if(strlen($ID) != 8) throw new Exception('学生証の読み取りができませんでした'.h($ID));
    if(strlen($_POST['ISBN']) != 13) throw new Exception('ISBNが不正です'.h($_POST['ISBN']));
    else $ISBN = $_POST['ISBN'];
    if($_POST['dc'] != "loan" && $_POST['dc'] != "return") throw new Exception('貸出返却の選択が不正です。'.h($_POST['dc']));
    else $dc = $_POST['dc'];
  }
  catch(Exception $e){
    echo "エラーが発生しました: " . h($e->getMessage()) . "";
    echo "<br><a href=\"./loan.html\">貸出・返却に戻る</a>";
    die();
  }
  echo h($ID)."\n".h($ISBN)."\n".h($dc);

  if($dc == 'loan'){
    try {
      $sql = "select status from books where ISBN like '.$ISBN.'";
      $stmh = $db->prepare($sql);
      $stmh->execute();
      $status = $stmh->fetch(PDO::FETCH_ASSOC);
      if($status != '貸出可能') throw new Exception("この書籍は現在貸出中となっています。");
      $sql = "UPDATE books SET `status` = ?, `borrower` = ? WHERE ISBN = ?";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(1, '貸出中', PDO::PARAM_STR);
      $stmt->bindValue(2, $ID, PDO::PARAM_STR);
      $stmt->bindValue(3, $ISBN, PDO::PARAM_STR);
      $stmt->execute();
      $sql = "insert into `history` (ID, date_time, ISBN, processer, process) values (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(1, NULL, PDO::PARAM_STR);
      $stmt->bindValue(2, NULL, PDO::PARAM_STR);
      $stmt->bindValue(3, $ISBN, PDO::PARAM_STR);
      $stmt->bindValue(4, $ID, PDO::PARAM_STR);
      $stmt->bindValue(5, "貸出", PDO::PARAM_STR);
      $stmt->execute();
      $db = null;

      echo "貸出処理が完了しました。<br>";
      echo "<a href=\"./\">リストに戻る</a>";
    }
    catch (Exception $e) {
      echo "エラーが発生しました: " . h($e->getMessage()) . "";
      echo "<br><a href=\"./\">リストに戻る</a>";
      die();
    }
  }
  else if($dc == 'return'){
    try {
      $sql = "select status from books where ISBN like '.$ISBN.'";
      $stmh = $db->prepare($sql);
      $stmh->execute();
      $status = $stmh->fetch(PDO::FETCH_ASSOC);
      if($status == '貸出可能') throw new Exception("この書籍は貸し出されておりません。");
      $sql = "UPDATE books SET `status` = ?, `borrower` = ? WHERE ISBN = ?";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(1, '貸出可能', PDO::PARAM_STR);
      $stmt->bindValue(2, '部室内書庫', PDO::PARAM_STR);
      $stmt->bindValue(3, $ISBN, PDO::PARAM_STR);
      $stmt->execute();
      $sql = "insert into `history` (ID, date_time, ISBN, processer, process) values (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(1, NULL, PDO::PARAM_STR);
      $stmt->bindValue(2, NULL, PDO::PARAM_STR);
      $stmt->bindValue(3, $ISBN, PDO::PARAM_STR);
      $stmt->bindValue(4, $ID, PDO::PARAM_STR);
      $stmt->bindValue(5, "返却", PDO::PARAM_STR);
      $stmt->execute();
      $db = null;

      echo "返却処理が完了しました。<br>";
      echo "<a href=\"./\">リストに戻る</a>";
    }
    catch (Exception $e) {
      echo "エラーが発生しました: " . h($e->getMessage()) . "";
      echo "<br><a href=\"./\">リストに戻る</a>";
      die();
    }
  }
?>