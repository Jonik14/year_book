<?php
if(!isset($_SESSION['id'])){
	header("Location:login.php?error=This page requires a login");
	die();
	
	}

?>
