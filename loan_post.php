<?php
  require_once 'DbManager.php';
  require_once 'UserManager.php';
  try{
    if(strlen($_POST['ISBN']) != 13) throw new Exception('ISBNが不正です。'.h($_POST['ISBN']));
    else $ISBN = $_POST['ISBN'];
    if(strlen($_POST['ID']) != 10) throw new Exception('学生IDが不正です。'.h($_POST['ID']));
    else $ID = $_POST['ID'];
    if($_POST['dc'] != "貸出" && $_POST['dc'] != "返却") throw new Exception('貸出返却の選択が不正です。'.h($_POST['dc']));
    else $dc = $_POST['DC'];
  }
  catch(Exception $e){
    echo "エラーが発生しました: " . h($e->getMessage()) . "";
    echo "<br><a href=\"./loan.html\">貸出・返却に戻る</a>";
    die();
  }
  echo h($ID)."\n".h($ISBN)."\n".h($dc);
 
#  try {
#    if (empty($_POST['ISBN'])) throw new Exception('ISBNが指定されていません。');
#    $ID = (int) $_POST['ISBN'];
#    $dbh = getDb();
#    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
#    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#    $sql = "UPDATE books SET title = ?, author = ?, publisher = ?, genre = ? WHERE ISBN = ?";
#    $stmt = $dbh->prepare($sql);
#    $stmt->bindValue(1, $title, PDO::PARAM_STR);
#    $stmt->bindValue(2, $author, PDO::PARAM_STR);
#    $stmt->bindValue(3, $publisher, PDO::PARAM_STR);
#    $stmt->bindValue(4, $genre, PDO::PARAM_STR);
#    $stmt->bindValue(5, $ISBN, PDO::PARAM_STR);
#    $stmt->execute();
#    $dbh = null;
#    echo "蔵書情報の更新が完了しました。<br>";
#    echo "<a href=\"./\">リストに戻る</a>";
#  }
#  catch (Exception $e) {
#    echo "エラーが発生しました: " . h($e->getMessage()) . "";
#    echo "<br><a href=\"./\">リストに戻る</a>";
#    die();
#  }
?>