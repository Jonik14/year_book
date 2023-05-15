<?php

define("DBNAME","year_book");
define("DBUSER","root");
define("DBPASS","");


try{
	$conn=new PDO("mysql:host=localhost;dbname=".DBNAME,DBUSER,DBPASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	
}catch(PDOException $e){
	
	echo $e->getMessage();
	}
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "year_book";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }


?>