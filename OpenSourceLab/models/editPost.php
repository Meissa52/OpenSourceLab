<?php
    $PostID = trim(filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_STRING));
	$PostMes = trim(filter_input(INPUT_POST, 'edit_post_message', FILTER_SANITIZE_STRING));
	$TimePost = trim(filter_input(INPUT_POST, 'post_time', FILTER_SANITIZE_STRING));
	$UserID= trim(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING));
	
	
	if (empty($PostMes) || empty($TimePost) || empty($UserID) || empty($PostID)){
		echo "Invalid Data Entry.  check all field and try again";
	}
	else {
		require_once('dbConnection.php');
		
        $statement = $db->prepare('UPDATE tblPosts SET Post = :post, PostTime = :posttime, UserID = :userid WHERE PostID = :postid');
        
        $statement->bindValue(':postid',$PostID);
		$statement->bindValue(':post',$PostMes);
		$statement->bindValue(':posttime',$TimePost);
		$statement->bindValue(':userid',$UserID);
		
		$statement->execute();
		$message=urlencode("Post Was Successfully Edited!");
		$color=urlencode("green-text");
		header("Location: ../index.php?Message=".$message."&color=".$color);
	
	}
?>