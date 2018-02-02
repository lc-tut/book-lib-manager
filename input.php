<?php
try{
    if(mb_strlen($_GET['isbn']) != 13) throw new Exception("ISBNが不正です。");
    $isbn = $_GET['isbn'];

    $openbd_data = json_decode(file_get_contents("https://api.openbd.jp/v1/get?isbn=$isbn"));

    $isbn = $openbd_data[0]->summary->isbn;
    $title = $openbd_data[0]->summary->title;
    $publisher = $openbd_data[0]->summary->publisher;
    $author = $openbd_data[0]->summary->author;
    
    print ('
    <!DOCTYPE HTML>
    <html>
    <head>
    <title>書籍情報登録</title>
    </head>

    <body>
    <h1>一般書籍情報登録</h1>
    <form method = "POST" action = "add_data.php">
    <p>
    ISBN:<br>
    <input type = "text" name = "ISBN" value = "'.$isbn.'" size = "150">
    </p><p>
    タイトル:<br>
    <input type = "text" name = "title" value = "'.$title.'" size = "150">
    </p><p>
    著者:<br>
    <input type = "text" name = "author" value = "'.$author.'" size = "150">
    </p><p>
    出版:<br>
    <input type = "text" name = "publisher" value = "'.$publisher.'"  size = "150">
    </p><p>
    ジャンル:<br>
    <input type = "text" name = "genre" value = "" size = "150">
    </p><p>
    <input type = "submit" value = "登録" />
    </form>

    </body>

    </html>
    ');
}
catch(Exception $e){
    echo "エラーが発生しました: ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    die();
}
?>