<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>検索結果</title>
    <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8" />
    <script src="jq/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="jq/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $("#booksTable").tablesorter();
        }
       );
    </script>
  </head>
  <body>
    <?php
      try{
        require_once 'DbManager.php';
        $db = getDb();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }
      try{
        if(empty($_GET['keyword'])) throw new Exception("検索キーワードが入力されていません");
        $char = $_GET['keyword'];
        $sql = "SELECT * FROM books WHERE title LIKE '%$char%' or author LIKE '%$char%' or publisher LIKE '%$char%' or genre LIKE '%$char%' or loan LIKE '%$char%' or borrower LIKE '%$char%'";
        $stmh = $db->prepare($sql);
        $stmh->execute();
      }catch(Exception $Exception){
        echo '検索エラー：' .$Exception->getMessage();
        die();
      }
    ?>
    <h1><?php echo "検索結果: ".$_GET[keyword]?></h1>
    <table class="books">
      <thead>
        <tr>
          <th>タイトル</th>
          <th>著者</th>
          <th>出版社</th>
          <th>ジャンル</th>
          <th>貸出状況</th>
          <th>借用者</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        ?>
          <tr>
            <td><a href="edit.php?id=<?=h($row['ISBN'])?>"><?=h($row['title'])?></a></th>
        		<td><a href="refine.php?column=author&text=<?=h($row['author'])?>"><?=h($row['author'])?></a></th>
        		<td><a href="refine.php?column=publisher&text=<?=h($row['publisher'])?>"><?=h($row['publisher'])?></a></th>
        		<td><a href="refine.php?column=genre&text=<?=h($row['genre'])?>"><?=h($row['genre'])?></a></th>
        		<td><a href="refine.php?column=loan&text=<?=h($row['loan'])?>"><?=h($row['loan'])?></a></th>
        		<td><a href="refine.php?column=borrower&text=<?=h($row['borrower'])?>"><?=h($row['borrower'])?></a></th>
          </tr>
            <?php
        }
          $db = null;
        ?>
      </tbody>
    </table>
    <a href="./">一覧に戻る</a>
  </body>
</html>
