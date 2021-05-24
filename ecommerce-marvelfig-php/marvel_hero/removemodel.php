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

	$sql="DELETE FROM product WHERE product_id = '" .$_POST["product_id"]."'";
		
		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		} else {
			header('Location: removemodel_form.php');
		}


		mysqli_close($conn);
	?>
