<?php
require_once 'config.php';


// $sql="UPDATE register SET Name ='".$_POST["Name"]."'Address='".$_POST["Address"]."'Age=".$_POST['Age']"
//     WHERE Name ='".$_SESSION["Name"]."'";
// $sql="UPDATE register SET Name ='Naruto', Address ='Address', Age ='15'
//     where Username = '".$_SESSION['Username']."'";
    $sql="UPDATE register SET Name = '" . $_POST["Name"] ."' , Address = '" . $_POST["Address"] ."' , Age = '" . $_POST["Age"] ."'
    where Username = '".$_SESSION['Username']."'";
    $dbquery = mysqli_query($conn, $sql);
    
    // if(file_exists("images/". $_FILES["name_img"]["name"])){
    //     echo $_FILES["name_img"]["name"]." already exits.<br /><br />";
    // }else{
    //     move_uploaded_file($_FILES["name_img"]["tmp_name"],"images/".$_FILES["name_img"]["name"]);
    // }

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        echo "<center><br /> Add Model Complete!";
        echo "<p align=\"center\"><form action=addhero_form.php name=addcomlete method=post><br /><input name=back type=submit id=back value=Back></a></p>";
        // header('Location: index_admin.php');
    }
    mysqli_close($conn);
?>