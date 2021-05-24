<?php
require_once 'config.php';

		// echo $_POST["name_hero"]."<br/>";
		// echo $_POST["alias"]."<br/>";
		// echo $_POST["birthdate"]."<br/>";
		// echo $_POST["species"]."<br/>";
		// echo $_POST["powers"]."<br/>";
		// echo $_POST["name_action"]."<br/>";
		// echo $_POST["description"]."<br/>";
		// echo $_FILES["name_img"]["name"]."<br/>";
		// echo $_FILES["name_img2"]["name"]."<br/>";
		// echo $_FILES["name_img3"]["name"]."<br/>";
		// echo $_FILES["name_img4"]["name"]."<br/>";
		// echo $_FILES["name_img5"]["name"]."<br/>";

	$sql="INSERT INTO tbl_character(name_hero,alias,birthdate,species,powers,name_action,description,name_img,name_img2,name_img3,name_img4,name_img5)
		VALUES('"
		.$_POST["name_hero"]."','"
		.$_POST["alias"]."','"
		.$_POST["birthdate"]."','"
		.$_POST["species"]."','"
		.$_POST["powers"]."','"
		.$_POST["name_action"]."','"
		.$_POST["description"]."','"
		.$_FILES["name_img"]["name"]."','"
		.$_FILES["name_img2"]["name"]."','"
		.$_FILES["name_img3"]["name"]."','"
		.$_FILES["name_img4"]["name"]."','"
		.$_FILES["name_img5"]["name"]."')"; 
		
		if(file_exists("images/". $_FILES["name_img"]["name"])){
			echo $_FILES["name_img"]["name"]." already exits.<br /><br />";
		}else{
			move_uploaded_file($_FILES["name_img"]["tmp_name"],"images/".$_FILES["name_img"]["name"]);
		}

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		} else {
			echo "<center><br /> Add Model Complete!";
			echo "<p align=\"center\"><form action=addhero_form.php name=addcomlete method=post><br /><input name=back type=submit id=back value=Back></a></p>";
			// header('Location: index_admin.php');
		}
		mysqli_close($conn);
	?>
