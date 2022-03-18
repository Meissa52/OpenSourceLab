<?php
$Email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$Username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
$Password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));


if (empty($Email) || empty($Password) || empty($Username)){
	echo "Invalid Data Entry.  check all field and try again";
}
else {
    require_once('dbConnection.php');
    $newPass = password_hash($Password, PASSWORD_DEFAULT);
	
	$statement = $db->prepare('INSERT INTO tblusers (Email, Username, Password , RoleID) VALUES (:email,:username,:password,2)');
    
	$statement->bindValue(':email',$Email);
	$statement->bindValue(':username',$Username);
    $statement->bindValue(':password',$newPass);
    
	$statement->execute();
	$message=urlencode("Account Was Successfully Created!");
	$color=urlencode("green-text");
	header("Location: ../login.php?Message=".$message."&color=".$color);

}

?>

