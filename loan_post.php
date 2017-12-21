<?php
  require_once 'DbManager.php';
  require_once 'UserManager.php';
  try{
    if(strlen($_POST['ISBN']) != 13) throw new Exception('ISBNが不正です。'.h($_POST['ISBN']));
    else $ISBN = $_POST['ISBN'];
    if(strlen($_POST['ID']) != 10) throw new Exception('学生IDが不正です。'.h($_POST['ID']));
    else $ID = $_POST['ID'];
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
      $dbh = getDb();
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE books SET `status` = `?`, `borrower` = `?` WHERE ISBN = ?";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, '貸出中', PDO::PARAM_STR);
      $stmt->bindValue(2, $ISBN, PDO::PARAM_STR);
      $stmt->execute();
      $sql = 'insert into `'.$ISBN.'` `borrower` = `?`, `dc` = `?`';
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, $ID, PDO::PARAM_STR);
      $stmt->bindValue(2, "貸出", PDO::PARAM_STR);
      $stmt->execute();
      $dbh = null;

      #$dbu = getUser();
      #$dbu->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      #$dbu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      #$sql = "UPDATE books SET `status` = `?`, `borrower` = `?` WHERE ISBN = ?";
      #$stmt = $dbu->prepare($sql);
      #$stmt->bindValue(1, '貸出中', PDO::PARAM_STR);
      #$stmt->bindValue(2, '部室内書庫', PDO::PARAM_STR);
      #$stmt->execute();
      #$dbu = null;

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
      $dbh = getDb();
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE books SET `status` = `?`, `borrower` = `?` WHERE ISBN = ?";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, '部室内書庫', PDO::PARAM_STR);
      $stmt->bindValue(2, $ISBN, PDO::PARAM_STR);
      $stmt->execute();
      $sql = 'insert into `'.$ISBN.'` `borrower` = `?`, `dc` = `?`';
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, $ID, PDO::PARAM_STR);
      $stmt->bindValue(2, "返却", PDO::PARAM_STR);
      $stmt->execute();
      $dbh = null;

      #$dbu = getUser();
      #$dbu->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      #$dbu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      #$sql = "UPDATE books SET `status` = `?`, `borrower` = `?` WHERE ISBN = ?";
      #$stmt = $dbu->prepare($sql);
      #$stmt->bindValue(1, '貸出中', PDO::PARAM_STR);
      #$stmt->bindValue(2, '部室内書庫', PDO::PARAM_STR);
      #$stmt->execute();
      #$dbu = null;

      echo "貸出処理が完了しました。<br>";
      echo "<a href=\"./\">リストに戻る</a>";
    }
    catch (Exception $e) {
      echo "エラーが発生しました: " . h($e->getMessage()) . "";
      echo "<br><a href=\"./\">リストに戻る</a>";
      die();
    }

  }
?>