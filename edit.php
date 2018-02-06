<?php

  require_once '../DbManager.php'; 
  
  try { 
    if (empty($_GET['isbn'])) throw new Exception("ISBNが指定されていません");
    $ISBN = (int) $_GET['isbn'];
    if(mb_strlen($ISBN) != 13) throw new Exception("ISBNが間違っている可能性があります。");
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from books WHERE ISBN = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $ISBN, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
  } catch (Exception $e) {
    echo "エラーが発生しました: " . h($e->getMessage(), ENT_QUOTES, 'UTF-8') . "";
    die();
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>蔵書情報更新</title>
  </head>
  <body>
    <h1>編集</h1>
    <br>
      
    <form method="post" action="update_data.php">
      タイトル:
      <br>
      <input type="text" name="title" size="150" value="<?php echo h($result['title'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      著者:
      <br>
      <input type="text" name="author" size="150" value="<?php echo h($result['author'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      出版社:
      <br>
      <input type="text" name="publisher" size="150" value="<?php echo h($result['publisher'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      ジャンル:
      <br>
      <input type="text" name="genre" size="150" value="<?php echo h($result['genre'], ENT_QUOTES, 'UTF-8'); ?>">
      <input type="hidden" name="ISBN" value="<?php echo h($result['ISBN'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      <br>
      <input type="submit" value="登録">
    </form>
   
  </body>
</html>
