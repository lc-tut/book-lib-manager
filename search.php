<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>検索結果</title>
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
        $sql = "SELECT * FROM 一般 WHERE タイトル LIKE '%$char%' or 著者 LIKE '%$char%' or イラスト LIKE '%$char%' or 出版 LIKE '%$char%'";
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
          <th>イラスト</th>
          <th>出版</th>
          <th>種別</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        ?>
          <tr>
            <td><a href="edit.php?id=<?=htmlspecialchars($row['蔵書番号'])?>"><?=htmlspecialchars($row['タイトル'])?></a></th>
        		<td><a href="refine.php?column=著者&text=<?=htmlspecialchars($row['著者'])?>"><?=htmlspecialchars($row['著者'])?></a></th>
        		<td><a href="refine.php?column=イラスト&text=<?=htmlspecialchars($row['イラスト'])?>"><?=htmlspecialchars($row['イラスト'])?></a></th>
        		<td><a href="refine.php?column=出版&text=<?=htmlspecialchars($row['出版'])?>"><?=htmlspecialchars($row['出版'])?></a></th>
        		<td><a href="refine.php?column=種別&text=<?=htmlspecialchars($row['種別'])?>"><?=htmlspecialchars($row['種別'])?></a></th>
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
