<?php
session_start();
include('./includes/headers.php');
include('./includes/db.php');

if(isset($_POST['login'])){
    $error=array();




    if(empty($_POST['username'])){
        $error['username']="Enter Username";
    }

    if(empty($_POST['password'])){
        $erro['password']="Enter Password";
    }


if(empty($error)){

    $stmt=$conn->prepare("SELECT * FROM users WHERE username=:un");
    $stmt->bindParam(":un",$_POST['username']);
    $stmt->execute();
    $record=$stmt->fetch(PDO::FETCH_BOTH);
    if($stmt->rowCount() > 0 && password_verify($_POST['password'],$record['password'])){
       

        $_SESSION['id'] = $record['user_id'];
		$_SESSION['name'] = $record['name'];

        header("Location:dashboard.php");
        exit();

   
}


}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>YEARBOOK</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  
</head>
<body>

<div class="header">
     <h1>EKSU 2023 SET YEARBOOK</h1>
      <p>Enter Details To Login</p>
</div>

<div class="form">




<form action="" method="POST">

<div class="form-group" >
<?php if(isset($error['username'])){
	echo $error['username'];
	} 
 ?>
    <input type="text" name="username" Placeholder="Enter Username" class="form-control" required>
</div>

<div class="form-group">
<?php if(isset($error['password'])){
	echo $error['password'];
	} 
 ?>
    <input type="password" name="password" Placeholder="Enter Password" class="form-control"  required>
</div>

<div >
    <input type="submit" name="login" value="Login" class="btn btn-primary">
</div>

</form>
</div>
<script src="jquery.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>