<?php
  require_once '../conf/DbManager.php';
 
  try {
    if (empty($_POST['ISBN'])) throw new Exception('ISBNが指定されていません。');
    if (strlen((int)($_POST['ISBN']) != 13)) throw new Exception('ISBNが間違っている可能性があります。');
    $db = getDb();
    $sql = "UPDATE books SET title = ?, author = ?, publisher = ?, genre = ? WHERE ISBN = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindValue(2, $_POST['author'], PDO::PARAM_STR);
    $stmt->bindValue(3, $_POST['publisher'], PDO::PARAM_STR);
    $stmt->bindValue(4, $_POST['genre'], PDO::PARAM_STR);
    $stmt->bindValue(5, $_POST['ISBN'], PDO::PARAM_STR);
    $stmt->execute();
    $db = null;
    echo "蔵書情報の更新が完了しました。<br>";
    echo "<a href=\"./\">リストに戻る</a>";
  }
  catch (Exception $e) {
    echo "エラーが発生しました: " . h($e->getMessage()) . "";
    echo "<br><a href=\"./\">リストに戻る</a>";
    die();
  }
?>