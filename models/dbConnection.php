<?php
$dsn = 'mysql:dbname=socialmedia;host=localhost;port=3307;charset=utf8';
$username = 'root';
$password = '';
try {
    $db = new PDO($dsn,$username,$password);
}
catch  (PODException $e){
    $error_message = $e->getMessage();
    include('../views/database_errors.php');
    exit();
}
?>