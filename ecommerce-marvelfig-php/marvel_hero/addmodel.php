<?php
require_once 'config.php';

// echo $_POST["name"]."<br/>";
// echo $_POST["price"]."<br/>";
// echo $_POST["size"]."<br/>";
// echo $_POST["description"]."<br/>";
// echo $_FILES["name_img"]['name']."<br/>";
// echo $_FILES["name_img2"]['name']."<br/>";
// echo $_FILES["name_img3"]['name']."<br/>";
// echo $_FILES["name_img4"]['name']."<br/>";
// echo $_FILES["name_img5"]['name']."<br/>";
// $name_img = $_FILES["name_img"]["name"];
// move_uploaded_file($_FILES["name_img"]["tmp_name"],"C:\xampp\htdocs\marvel_hero\images".$_FILES["name_img"]["name"]);

	$sql="INSERT INTO product(name_product,price,size,name_img)
		VALUES('"
		.$_POST["name"]."','"
		.$_POST["price"]."','"
		.$_POST["size"]."','"
		.$_FILES["name_img"]["name"]."')";
		
		if(file_exists("images/". $_FILES["name_img"]["name"])){
			echo $_FILES["name_img"]["name"]." already exits.<br /><br />";
		}else{
			move_uploaded_file($_FILES["name_img"]["tmp_name"],"images/".$_FILES["name_img"]["name"]);
		}
		echo $_POST["name"]."<br/>";
		echo $_POST["price"]."<br/>";
		echo $_POST["size"]."<br/>";
		echo $_FILES["name_img"]['name']."<br/>";
		echo "<img  height = \"500px\"  align=\"center\" src=\"images/" . $_FILES["name_img"]["name"] . "\" />";
		// move_uploaded_file($_FILES["name_img"]["tmp_name"],"C:\xampp\htdocs\marvel_hero\images".$_FILES["name_img"]["name"]);

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		} else {
			 echo "<center><br /> Add Model Complete!";
			 echo "<p align=\"center\"><form action=addmodel_form.php name=addcomlete method=post><br /><input name=back type=submit id=back value=Back></a></p>";
			// header('Location: index_admin.php');
		}


		mysqli_close($conn);
	?>
