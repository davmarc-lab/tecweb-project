<?php
require_once("../../includes/database.php");
$idUser = $_POST["idUser"];
$idPreview = $_POST["idPreview"];

$query = "SELECT * FROM utente WHERE IdUser = $idUser";
$author = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

$idProfile = $author["IdMedia"];
$query = "SELECT * FROM media WHERE IdMedia = $idProfile";
$mediaPath = $dbh->execQuery($query, MYSQLI_ASSOC)[0]["FilePath"];

$query = "SELECT * FROM media WHERE IdMedia = $idPreview";
$previewPath = $dbh->execQuery($query, MYSQLI_ASSOC)[0]["FilePath"];

// prepare the json to be sent to javascript
echo("[ ". json_encode($author) . " , ");
echo("{ \"ProfilePath\":" . json_encode($mediaPath) . " }, ");
echo("{ \"PreviewPath\":" . json_encode($previewPath) . " }]");
?>