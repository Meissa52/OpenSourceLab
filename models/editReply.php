<?php
    $ReplyID = trim(filter_input(INPUT_POST, 'reply_id', FILTER_SANITIZE_STRING));
	$ReplyMes = trim(filter_input(INPUT_POST, 'edit_reply_message', FILTER_SANITIZE_STRING));
	$TimePost = trim(filter_input(INPUT_POST, 'reply_time', FILTER_SANITIZE_STRING));
    $UserID= trim(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING));
    $PostID= trim(filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_STRING));
	
	
	if (empty($ReplyMes) || empty($TimePost) || empty($UserID) || empty($PostID) || empty($ReplyID)){
		echo "Invalid Data Entry.  check all field and try again";
	}
	else {
		require_once('dbConnection.php');
		
        $statement = $db->prepare('UPDATE tblReplies SET Reply = :reply, ReplyTime = :replytime, UserID = :userid, PostID = :postid WHERE ReplyID = :replyid');
        
        $statement->bindValue(':postid',$PostID);
		$statement->bindValue(':reply',$ReplyMes);
		$statement->bindValue(':replytime',$TimePost);
        $statement->bindValue(':userid',$UserID);
        $statement->bindValue('replyid',$ReplyID);
		
		$statement->execute();
		$message=urlencode("Post Was Successfully Edited!");
		$color=urlencode("green-text");
		header("Location: ../index.php?Message=".$message."&color=".$color);
	
	}
?>