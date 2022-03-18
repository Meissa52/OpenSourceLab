<?php
session_start();

$Email = $_POST['email'];
$Password = $_POST['password'];

if ((isset($Email)) || isset($Password)) {
    require_once('dbConnection.php');

    $statement = $db->prepare('SELECT * FROM tblusers WHERE email = :email');

    $statement->bindValue(':email',$Email);

    $statement->execute();

    $accounts = $statement->fetch();

    if($accounts && password_verify($Password, $accounts['Password'])){
        $_SESSION['email'] = $accounts['Email'];
        $_SESSION['userid'] = $accounts['UserID'];
        $_SESSION['username'] = $accounts['Username'];
        $_SESSION['role'] = $accounts['RoleID'];
        $message=urlencode("Account Was Login Successful!");
	    $color=urlencode("green-text");
	    header("Location: ../index.php?Message=".$message."&color=".$color);
    }
    else {
        header('Location: ../login.php');
    }
}
else {
    header('Location: ../login.php');
}
?>