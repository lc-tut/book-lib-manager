<?php
  require_once 'DbManager.php';
  $ISBN = $_POST['ISBN'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $publisher= $_POST['publisher'];
  $genre = $_POST['genre'];
  
  try {
    if (empty($_POST['ISBN'])) throw new Exception('ISBNが指定されていません。');
    $ID = (int) $_POST['ISBN'];
    $dbh = getDb();
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE books SET title = ?, author = ?, publisher = ?, genre = ? WHERE ISBN = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $title, PDO::PARAM_STR);
    $stmt->bindValue(2, $author, PDO::PARAM_STR);
    $stmt->bindValue(3, $publisher, PDO::PARAM_STR);
    $stmt->bindValue(4, $genre, PDO::PARAM_STR);
    $stmt->bindValue(5, $ISBN, PDO::PARAM_STR);
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
