<?php

function he($str){
    echo htmlspecialchars($str);
}

$isbn = $_GET['isbn'];

$openbd_data = json_decode(file_get_contents("https://api.openbd.jp/v1/get?isbn=$isbn"));



?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>書籍詳細</title>
    </head>
    <body>
        <h1>書籍詳細</h1>
        <img src="<?php he($openbd_data[0]->onix->DescriptiveDetail->CollateralDetail->SupportingResource->ResourceVersion->ResourceLink)?>" alt="書写">
    </body>