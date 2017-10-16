<?php
  require_once 'DbManager.php';
  $蔵書番号 = $_POST['蔵書番号'];
  $タイトル = $_POST['タイトル'];
  $著者 = $_POST['著者'];
  $イラスト= $_POST['イラスト'];
  $出版 = $_POST['出版'];
  $種別 = $_POST['種別'];
  
  try {
    if (empty($_POST['蔵書番号'])) throw new Exception('蔵書番号が指定されていません。');
    $ID = (int) $_POST['蔵書番号'];
    $dbh = getDb();
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE 一般 SET タイトル = ?, 著者 = ?, イラスト = ?, 出版 = ?, 種別 = ? WHERE 蔵書番号 = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $タイトル, PDO::PARAM_STR);
    $stmt->bindValue(2, $著者, PDO::PARAM_STR);
    $stmt->bindValue(3, $イラスト, PDO::PARAM_STR);
    $stmt->bindValue(4, $出版, PDO::PARAM_STR);
    $stmt->bindValue(5, $種別, PDO::PARAM_STR);
    $stmt->bindValue(6, $蔵書番号, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "蔵書情報の更新が完了しました。<br>";
    echo "<a href=\"./\">リストに戻る</a>";
  }
  catch (Exception $e) {
    echo "エラーが発生しました: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "";
    echo "<br><a href=\"./\">リストに戻る</a>";
    die();
  }
?>
