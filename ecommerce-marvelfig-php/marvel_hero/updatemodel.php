<?php
require_once 'config.php';


    $sql="UPDATE product SET product_id = '" . $_POST["product_id"] ."' , name_product = '" . $_POST["name_hero"] ."' , price = '" . $_POST["price"] ."',
    size = '" . $_POST["size"] ."', name_img = '" . $_FILES["name_img"]["name"] ."'
    where product_id = '".$_POST['product_id']."'";
    $dbquery = mysqli_query($conn, $sql);
    if(file_exists("images/". $_FILES["name_img"]["name"])){
        echo $_FILES["name_img"]["name"]." already exits.<br /><br />";
    }else{
        move_uploaded_file($_FILES["name_img"]["tmp_name"],"images/".$_FILES["name_img"]["name"]);
    }

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        echo "<center><br /> Add Model Complete!";
        echo "<p align=\"center\"><form action=updatemodel_form.php name=addcomlete method=post><br /><input name=back type=submit id=back value=Back></a></p>";
        // header('Location: index_admin.php');
    }
    mysqli_close($conn);
?>