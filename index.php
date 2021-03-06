<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>書籍一覧</title>
    <link rel=stylesheet href="main.css" type="text/css" charset="utf-8" />
    <script src="jq/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="jq/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#booksTable").tablesorter();
        }
      );
    </script>
  </head>
  <body>
    <h1>書籍一覧</h1>
    
    <ul class="func">
    <li class="func_search">
      <form action="search.php" method="get">
        <input type="text" name="keyword" size="75" value="">
        <input type="submit" value="検索">
      </form>
    </li>
      <li class="func_add"><input type="button" value="蔵書追加" onclick="location.href='input.html'" /></li>
      <li class="func_add"><input type="button" value="貸出・返却" onclick="location.href='loan.html'" /></li>
    </ul>
    <?php
      require_once '../conf/DbManager.php';
      try{
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $stmh = $db->prepare($sql);
        $stmh->execute();
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }
    ?>
    <table id="booksTable" class="books">
      <thead>
        <tr>
          <th>タイトル</th>
          <th>著者</th>
          <th>出版社</th>
          <th>ジャンル</th>
          <th>貸出状況</th>
          <th>所在・借用者</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data_num = 0;
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
          $data_num++;
        ?>
          <tr>
            <td><a href="detail.php?isbn=<?=h($row['ISBN'])?>"><?=h($row['title'])?></a></th>
        	  <td><a href="refine.php?column=author&text=<?=h($row['author'])?>"><?=h($row['author'])?></a></th>
        	  <td><a href="refine.php?column=publisher&text=<?=h($row['publisher'])?>"><?=h($row['publisher'])?></a></th>
        	  <td><a href="refine.php?column=genre&text=<?=h($row['genre'])?>"><?=h($row['genre'])?></a></th>
        	  <td><a href="refine.php?column=status&text=<?=h($row['status'])?>"><?=h($row['status'])?></a></th>
        	  <td><a href="refine.php?column=borrower&text=<?=h($row['borrower'])?>"><?=h($row['borrower'])?></a></th>
          </tr>
        <?php 
          }
        ?>
      </tbody>
    </table>
    <?php 
      echo "データ件数: ".h($data_num);
      $db = null;
    ?>
  </body>
</html>