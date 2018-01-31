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
        $sql = "select status from books where ISBN like '9784791960279';";
        $stmh = $db->prepare($sql);
        $stmh->execute();
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }
      $row = $stmh->fetch(PDO::FETCH_ASSOC);
      echo $row['status'];
      $db = null;

      try{
        require_once 'DbManager.php';
        $db = getDb();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }
      try{
        $sql = "select * from books";
        $stmh = $db->prepare($sql);
        $stmh->execute();
      }catch(PDOException $Exception){
        die('接続エラー：' .$Exception->getMessage());
      }
      while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        $userData[]=array(
        'ISBN'=>$row['ISBN'],
        'title'=>$row['title'],
        'author'=>$row['author'],
        'publisher'=>$row['publisher'],
        'genre'=>$row['genre'],
        'status'=>$row['status'],
        'borrower'=>$row['borrower']
        );
    }
    header('Content-type: application/json');
    echo json_encode($books_data);
?>