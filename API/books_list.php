<?php
      require_once '../../conf/DbManager.php';
      try{
        $sql = "select * from books";
        $stmh = $db->prepare($sql);
        $stmh->execute();
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }

      $books_data = array();
      while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        $books_data[]=array(
        'ISBN'=>$row['ISBN'],
        'title'=>$row['title'],
        'author'=>$row['author'],
        'publisher'=>$row['publisher'],
        'genre'=>$row['genre'],
        'status'=>$row['status'],
        'borrower'=>$row['borrower']
        );
    $db = null;
    }
    header('Content-type: application/json');
    echo json_encode($books_data, JSON_UNESCAPED_UNICODE);
?>
