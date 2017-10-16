<?php

  require_once 'DbManager.php'; 
  
  try { 
  
    $db = getDb();
    
    if (empty($_GET['id'])) throw new Exception("蔵書番号が指定されていません");
    $ID = (int) $_GET['id'];
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from 一般 WHERE 蔵書番号 = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $ID, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
  } catch (Exception $e) {
    echo "エラーが発生しました: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "";
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
      <input type="text" name="タイトル" size="150" value="<?php echo htmlspecialchars($result['タイトル'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      著者:
      <br>
      <input type="text" name="著者" size="150" value="<?php echo htmlspecialchars($result['著者'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      イラスト:
      <br>
      <input type="text" name="イラスト" size="150" value="<?php echo htmlspecialchars($result['イラスト'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      出版:
      <br>
      <input type="text" name="出版" size="150" value="<?php echo htmlspecialchars($result['出版'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      種別:
      <br>
      <input type="text" name="種別" size="150" value="<?php echo htmlspecialchars($result['種別'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      <input type="hidden" name="蔵書番号" value="<?php echo htmlspecialchars($result['蔵書番号'], ENT_QUOTES, 'UTF-8'); ?>">
      <br>
      <br>
      <input type="submit" value="登録">
    </form>
   
  </body>
</html>
