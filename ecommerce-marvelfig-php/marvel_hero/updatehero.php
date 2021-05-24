<?php
require_once 'config.php';


    $sql="UPDATE tbl_character SET hero_id = '" . $_POST["hero_id"] ."' , name_hero = '" . $_POST["name_hero"] ."' , alias = '" . $_POST["alias"] ."',
    birthdate = '" . $_POST["birthdate"] ."', species = '" . $_POST["species"] ."', powers = '" . $_POST["powers"] ."',name_action = '" . $_POST["name_action"] ."'
    ,description = '" . $_POST["description"] ."', name_img = '" . $_FILES["name_img"]["name"] ."', name_img2 = '" . $_FILES["name_img2"]["name"] ."',
    name_img3 = '" . $_FILES["name_img3"]["name"] ."', name_img4= '" . $_FILES["name_img4"]["name"] ."', name_img5 = '" . $_FILES["name_img5"]["name"] ."'
    where hero_id = '".$_POST['hero_id']."'";
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
        echo "<p align=\"center\"><form action=addhero_form.php name=addcomlete method=post><br /><input name=back type=submit id=back value=Back></a></p>";
        // header('Location: index_admin.php');
    }
    mysqli_close($conn);
?>