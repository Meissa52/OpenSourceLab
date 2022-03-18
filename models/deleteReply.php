<?php
$ReplyID = trim(filter_input(INPUT_POST, 'ReplyID', FILTER_SANITIZE_STRING));

require_once "dbConnection.php";

$stmt = $db->prepare('DELETE FROM tblReplies WHERE ReplyID = :replyid');
$stmt->bindValue(':replyid', $ReplyID);
$stmt->execute();

header("Location: ../index.php");
?>