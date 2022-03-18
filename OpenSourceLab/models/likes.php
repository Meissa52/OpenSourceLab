<?php
	$likes = trim(filter_input(INPUT_POST, 'PostID', FILTER_VALIDATE_INT));
	
	
	
	if (empty($likes)){
		echo "Invalid Data Entry. check all field and try again";
	}
	else {
		require_once('dbConnection.php');
		
		$statement = $db->prepare('UPDATE tblposts SET likes = likes+1 WHERE PostID = :PostID ');
		
		$statement->bindValue(':PostID',$likes);
	
		
		$statement->execute();
		$message=urlencode("like was Successfull!");
		$color=urlencode("green-text");
		header("Location: ../index.php?Message=".$message."&color=".$color);
	
	}
?>