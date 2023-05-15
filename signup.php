<?php
session_start();
include './includes/db.php';
include('./includes/headers.php');


if(isset($_POST['submit'])){
    $error=array();

    if(empty($_POST['name'])){
        $error['name']="Please Enter Fullname";
    }
    if(empty($_POST['phone'])){
        $error['phone']="Please Enter Phonenumber";
    
    }
    if(empty($_POST['username'])){
        $error['username']="Please Enter Username";

    }
    if(empty($_POST['email'])){
        $error['email']="Please Enter Email";

    }else{
       
        $statement=$conn->prepare("SELECT * FROM users WHERE email=:em");
        $statement->bindParam(":em",$_POST['email']);
        $statement->execute();
        if($statement->rowCount() > 0){
            $error['email']="Email already exists";	
        }
    }


    if(empty($_POST['password'])){
        $error['password']="Please Create Password";
    }
    if(empty($_POST['confirm_password'])){
        $error['confirm_password']="Plese Confirm Password";
    }elseif($_POST['password']!==$_POST['confirm_password']){

        $error['confirm_password']="Password Mismatch";
    }


if(empty($error)){
        $encrypted=password_hash($_POST['password'],PASSWORD_BCRYPT);
       
        $stmt=$conn->prepare("INSERT INTO users VALUES(NULL,:nm,:ph,:un,:em,:pw,NOW(),NOW())");

        $stmt->bindParam(":nm",$_POST['name']);
        $stmt->bindParam(":ph",$_POST['phone']);
        $stmt->bindParam(":un",$_POST['username']);
        $stmt->bindParam(":em",$_POST['email']);
        $stmt->bindParam(":pw",$encrypted);
        $stmt->execute();
       
        header("Location:login.php");
        exit();


}

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Year Book</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

   
    
</head>
<body>

<div class="header">
     <h1>EKSU 2023 SET YEARBOOK</h1>
      <h3>Please Create An Account</h3>
</div>

    <div class="form">

    <form action="" method="POST">

   <div >
       <div class="form-group" ; >
       <?php if(isset($error['name'])){
	echo $error['name'];
	} 
 ?>

       <input type="name" name="name" Placeholder="Enter FullName" class="form-control" required>   
</div>

<div class="form-group" ;>
<?php if(isset($error['Phone'])){
	echo $error['Phone'];
	} 
 ?>
<input type="number" name="phone"  Placeholder="Enter Phonenumber" class="form-control" required>

</div>

<div class="form-group" >

<?php if(isset($error['email'])){
	echo $error['email'];
	} 
 ?>
    <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
</div>

<div class="form-group";>
<?php if(isset($error['username'])){
	echo $error['username'];
	} 
 ?>
    <input type="text" name="username" Placeholder="Enter Username" class="form-control" required>
</div>

<div class="form-group" ;>
<?php if(isset($error['password'])){
	echo $error['password'];
	} 
 ?>
    <input type="password" name="password" Placeholder="Create Password" class="form-control"  required>
</div>

<div class="form-group"  >

<?php if(isset($error['confirm_password'])){
	echo $error['confirm_password'];
	} 
 ?>
    <input type="password" name="confirm_password" Placeholder="Confirm_Password" class="form-control"  required>
</div>


<div >
    <input type="submit" name="submit" value="Create Acount" class="btn btn-primary">
</div>

    </form>

    </div>
    
    <script src="jquery.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="./bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</body>
</html>