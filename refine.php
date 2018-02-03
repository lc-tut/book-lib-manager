<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>絞り込み</title>
    <link rel=stylesheet href="main.css" type="text/css" charset="utf-8" />
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
    require_once 'DbManager.php';
    try{
      $column = $_GET['column'];
      $char = $_GET['text'];
      $sql = "SELECT * FROM books WHERE $column LIKE '%$char%'";
      $stmh = $db->prepare($sql);
      $stmh->execute();
    }catch(Exception $Exception){
      echo '検索エラー：' .$Exception->getMessage();
      die();
    }
    ?>
    <h1>絞り込み <?php echo h($_GET['column']).": ".h($_GET['text']); ?></h1>
    <table class="books">
      <thead>
        <tr>
          <th>タイトル</th>
          <th>著者</th>
          <th>出版</th>
          <th>ジャンル</th>
          <th>貸出状況</th>
          <th>所在・借用者</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
            ?>
              <tr>
                <td><a href="edit.php?isbn=<?=h($row['ISBN'])?>"><?=h($row['title'])?></a></th>
          		  <td><a href="refine.php?column=author&text=<?=h($row['author'])?>"><?=h($row['author'])?></a></th>
          		  <td><a href="refine.php?column=publisher&text=<?=h(['publisher'])?>"><?=h($row['publisher'])?></a></th>
          		  <td><a href="refine.php?column=genre&text=<?=h($row['genre'])?>"><?=h($row['genre'])?></a></th>
          		  <td><a href="refine.php?column=loan&text=<?=h($row['status'])?>"><?=h($row['status'])?></a></th>
          		  <td><a href="refine.php?column=borrower&text=<?=h($row['borrower'])?>"><?=h($row['borrower'])?></a></th>
              </tr>
            <?php
          }
          $db = null;
        ?>
      </tbody>
    </table>
    <a href="./">一覧に戻る</a>
    <?php echo "データ件数: ".h($data_num);?>
  </body>
</html>