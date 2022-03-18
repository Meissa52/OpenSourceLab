<?php
	$PostRep = trim(filter_input(INPUT_POST, 'create_reply', FILTER_SANITIZE_STRING));
	$RepTime = trim(filter_input(INPUT_POST, 'reply_time', FILTER_SANITIZE_STRING));
	$UserID= trim(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING));
    $PostID= trim(filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_STRING));
	
	if (empty($PostRep) || empty($RepTime) || empty($UserID) || empty($PostID)){
		echo "Invalid Data Entry.  check all field and try again";
	}
	else {
		require_once('dbConnection.php');
		
		$statement = $db->prepare('INSERT INTO tblreplies (Reply, ReplyTime, UserID, PostID, likes) VALUES (:reply, :replytime, :userid, :postid, :0);');
		
		$statement->bindValue(':reply',$PostRep);
		$statement->bindValue(':replytime',$RepTime);
        $statement->bindValue(':userid',$UserID);
        $statement->bindValue(':postid',$PostID);
		
		$statement->execute();
		$message=urlencode("Reply Successfully Created!");
		$color=urlencode("green-text");
		header("Location: ../index.php?Message=".$message."&color=".$color);
	
	}
?>