<?php

session_start();
include ('./includes/db.php');
include ('./includes/headers.php');

if(!isset($_SESSION['id'])){
	header("Location:login.php?error=This page requires a login");
	die();
	
	}

$statement=$conn->prepare("SELECT * FROM users  WHERE user_id=:uid");
$statement->bindParam(":uid",$_SESSION['id']);
$statement->execute();
$stmt=$conn->prepare("SELECT user_id, pics_name FROM uploads WHERE user_id=:uid");
$stmt->bindParam(":uid",$_SESSION['id']);
$stmt->execute();
$stmtt=$conn->prepare("SELECT user_id, pics_name FROM uploads ");
$stmtt->execute();


if($statement->rowCount() < 1){
	header("Location:login.php?error=This record doesn't on our system");
	}

$current_users_data=$statement->fetch(PDO::FETCH_BOTH);





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Dashboard</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="container" style="background-image: url(bg.jpg);background-repeat: no-repeat; background-position: left top; background-size: cover; ">


<?php
    include('./includes/index.php');
?>
<script src="jquery.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="./bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
