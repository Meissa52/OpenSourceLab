<?php
	$PostMes = trim(filter_input(INPUT_POST, 'create_post', FILTER_SANITIZE_STRING));
	$TimePost = trim(filter_input(INPUT_POST, 'post_time', FILTER_SANITIZE_STRING));
	$UserID= trim(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING));
	
	
	if (empty($PostMes) || empty($TimePost) || empty($UserID)){
		echo "Invalid Data Entry. check all field and try again";
	}
	else {
		require_once('dbConnection.php');
		
		$statement = $db->prepare('INSERT INTO tblposts (Post, PostTime, UserID, likes) VALUES (:post, :posttime, :userid, :0);');
		
		$statement->bindValue(':post',$PostMes);
		$statement->bindValue(':posttime',$TimePost);
		$statement->bindValue(':userid',$UserID);
		
		$statement->execute();
		$message=urlencode("Post Successfully Created!");
		$color=urlencode("green-text");
		header("Location: ../index.php?Message=".$message."&color=".$color);
	
	}
?>