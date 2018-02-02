<?php
try{
    if(mb_strlen($_GET['isbn']) != 13) throw new Exception("ISBNが不正です。");
    $isbn = $_GET['isbn'];
    $API_XML = simplexml_load_file("http://www.hanmoto.com/api/book.php?ISBN=$isbn");
    $json = json_encode($API_XML);
    $API_DATA = json_decode($json, true);
    $isbn = $API_DATA['Head']["param"]['isbn'];
    $title = $API_DATA['Book']['Product']['DescriptiveDetail']['TitleDetail']['TitleElement']['TitleText'];
    $author = $API_DATA['Book']['Product']['DescriptiveDetail']['Contributor']['0']['PersonName'];
    $publisher = $API_DATA['Book']['Product']['PublishingDetail']['Imprint']['ImprintName'];
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