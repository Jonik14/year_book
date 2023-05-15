<?php
session_start();
include('./db.php');
$stmtt=$conn->prepare("SELECT count(*) as total FROM uploads WHERE user_id=:uid");
$stmtt->bindParam(":uid",$_SESSION['id']);
$stmtt->execute();
$row = $stmtt->fetch(PDO::FETCH_ASSOC);
if($row['total'] === 0){
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             $gg = $_FILES['fileToUpload']['name'];
            $joe=$_SESSION['id'];
            $statement=$conn->prepare("INSERT INTO uploads VALUES(NULL,:ui,:pn,NULL)");
            $statement->bindParam(":ui",$joe);
            $statement->bindParam(":pn",$gg);
            $statement->execute();
            header("Location: ../dashboard.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}else{
    echo "You already exceed the limit of Image required";
}
?>