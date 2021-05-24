<?php
require_once 'config.php';
$username = $_POST['Username'];
$password = $_POST['Password'];

// echo $username;
// echo $password;

$sql = "SELECT * FROM register WHERE Username = '$username' AND Password = '$password' ";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        // echo "user " . $row['Username'];
        // echo $row['Password'];
        if($row['User_Type'] == "admin") { 
            header('Location: index_admin.php');
            $_SESSION['Username']=$row["Username"];
            $_SESSION['Users_id']=$row["Users_id"];
        } else if($row['User_Type'] == "user") {
            header('Location: index.php');
            $_SESSION['Username']=$row["Username"];
            $_SESSION['Users_id']=$row["Users_id"];
        }      
    }
} else{
    header('Location: Login.php');
    }

mysqli_close($conn);
?>
