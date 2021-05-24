<?php
require_once 'config.php';

   
	$con = mysqli_connect("localhost","root","");
	if(!$con) die("Could not connect: " . mysqli_error());
	
	mysqli_select_db($con,"marvel");
	mysqli_set_charset($con,"utf8");
	
	$sql="INSERT INTO register(Username,Password,Name,Age,Birthdate,Address,Sex,User_Type)
		VALUES('"
		.$_POST["Username"]."','"
		.$_POST["Password"]."','"
		.$_POST["Name"]."','"
		.$_POST["Age"]."','"
		.$_POST["Birthdate"]."','"
		.$_POST["Address"]."','"
		.$_POST["Sex"]."','user')";

	if(!mysqli_query($con, $sql)){
		die("Error:". mysqli_error());
		}else{
		echo " สมัครสมาชิกเรียบร้อยแล้ว ";
		}

		mysqli_close($con);
	?>
