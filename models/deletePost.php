<?php
$PostID = trim(filter_input(INPUT_POST, 'PostID', FILTER_SANITIZE_STRING));

require_once "dbConnection.php";

$stmt = $db->prepare('DELETE FROM tblposts WHERE PostID = :postid');
$stmt->bindValue(':postid', $PostID);
$stmt->execute();

header("Location: ../index.php");
?>