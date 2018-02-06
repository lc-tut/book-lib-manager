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
    <img src="<?php he($openbd_data[0]->onix->CollateralDetail->SupportingResource[0]->ResourceVersion[0]->ResourceLink)?>" alt="書写">
    <table border="1">
        <tr>
            <td>タイトル</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->TitleDetail->TitleElement->TitleText->content)?></td>
        </tr>
        <tr>
            <td>タイトル (ヨミ)</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->TitleDetail->TitleElement->TitleText->collationkey)?></td>
        </tr>
        <tr>
            <td>著者1</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[0]->PersonName->content)?></td>
        </tr>
        <tr>
            <td>著者1(ヨミ)</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[0]->PersonName->collationkey)?></td>
        </tr>
        <tr>
            <td>著者2</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[1]->PersonName->content)?></td>
        </tr>
        <tr>
            <td>著者2(ヨミ)</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[1]->PersonName->collationkey)?></td>
        </tr>
        <tr>
            <td>著者3</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[2]->PersonName->content)?></td>
        </tr>
        <tr>
            <td>著者3(ヨミ)</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[2]->PersonName->collationkey)?></td>
        </tr>
        <tr>
            <td>著者4</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[3]->PersonName->content)?></td>
        </tr>
        <tr>
            <td>著者4(ヨミ)</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Contributor[3]->PersonName->collationkey)?></td>
        </tr>
        <tr>
            <td>ページ数</td>
            <td><?php he($openbd_data[0]->onix->DescriptiveDetail->Extent[0]->ExtentValue)?></td>
        </tr>
        <tr>
            <td>出版</td>
            <td><?php he($openbd_data[0]->onix->PublishingDetail->Imprint->ImprintName)?></td>
        </tr>
        <tr>
            <td>発行所</td>
            <td><?php he($openbd_data[0]->onix->PublishingDetail->Publisher->PublisherName)?></td>
        </tr>
        <tr>
            <td>内容・あらすじ</td>
            <td><?php he($openbd_data[0]->onix->CollateralDetail->TextContent[0]->Text)?></td>
        </tr>
    </table>
    <a href="edit.php?isbn=<?php echo h($isbn);?>">編集</a>
    <a href="delete_confirm.php?isbn=<?php echo h($isbn);?>">削除</a>
</body>