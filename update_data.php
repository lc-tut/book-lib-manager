<?php
  require_once 'DbManager.php';
 
  try {
    if (empty($_POST['ISBN'])) throw new Exception('ISBNが指定されていません。');
    if (mb_strlen($_POST['ISBN'] != 13) throw new Exception('ISBNが間違っている可能性があります。');
    $dbh = getDb();
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE books SET title = ?, author = ?, publisher = ?, genre = ? WHERE ISBN = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindValue(2, $_POST['author'], PDO::PARAM_STR);
    $stmt->bindValue(3, $_POST['publisher'], PDO::PARAM_STR);
    $stmt->bindValue(4, $_POST['genre'], PDO::PARAM_STR);
    $stmt->bindValue(5, $_POST['ISBN'], PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo "蔵書情報の更新が完了しました。<br>";
    echo "<a href=\"./\">リストに戻る</a>";
  }
  catch (Exception $e) {
    echo "エラーが発生しました: " . h($e->getMessage()) . "";
    echo "<br><a href=\"./\">リストに戻る</a>";
    die();
  }
?>