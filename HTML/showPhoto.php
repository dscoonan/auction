<?php
require_once '/u/dsc995/Desktop/cs105/openDatabase.php';
$detailQuery = $database->prepare(<<<'SQL'
SELECT ITEM_PHOTO FROM AUCTION
WHERE AUCTION_ID = :id;


SQL
);
$detailQuery->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$detailQuery->execute();

$detailArray = $detailQuery->fetch();  //gives array based on unique id
$detailQuery->closeCursor();
if (strlen($detailArray['ITEM_PHOTO']) == 0) {
    $photoContents = file_get_contents('images/no_image.jpg');
} else {
    $photoContents = $detailArray['ITEM_PHOTO'];
}

//var_dump($detailArray);

header('Content-Type: image/jpeg');
header('Content-Length: '.strlen($photoContents));
echo $photoContents;

