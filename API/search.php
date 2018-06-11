<?php
  require_once '../../conf/DbManager.php';
  try{
    if(empty($_GET['keyword'])) throw new Exception("検索キーワードが入力されていません");
    $char = $_GET['keyword'];
    $sql = "SELECT * FROM books WHERE title LIKE '%$char%' or author LIKE '%$char%' or publisher LIKE '%$char%' or genre LIKE '%$char%' or status LIKE '%$char%' or borrower LIKE '%$char%'";
    $stmh = $db->prepare($sql);
    $stmh->execute();
  }catch(Exception $Exception){
    echo '検索エラー：' .$Exception->getMessage();
    die();
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