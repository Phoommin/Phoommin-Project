<?php
   
    // include 'config.php';
    require_once 'config.php';
 
    $sql = "INSERT INTO order_buy(order_id, User_id, grand_total,
    card_no, order_date, order_status) VALUES (null, " .
    $_SESSION["Users_id"] . ", " . $_POST["grand_total"] .", '" .
    $_POST["card_no"] . "', '" . date("Y-m-d H:i:s") . "', 'New')";

    $result = mysqli_query($conn, $sql);
    if (!$result) die('Query error: ' . mysqli_error($conn));
    


    $sql = "SELECT MAX(order_id) AS order_id FROM order_buy WHERE
    User_id = " . $_SESSION["Users_id"];

    $result = mysqli_query($conn, $sql);
    if (!$result) die('Query error: ' . mysqli_error($conn));
    
    $row = mysqli_fetch_array($result);
    $order_id = $row['order_id'];
    $order_amount = $_POST["order_amount"];
    $i =0;
    for($i = 0; $i < $order_amount; $i++) {
    $product_id = "product_id" . $i;
    $amount = "amount" . $i;
    $sub_total = "sub_total" . $i;

    $sql = "INSERT INTO order_details (order_details_id, order_id,product_id,
   amount, sub_total) VALUES (null, " . $order_id . "," .
    $_POST[$product_id] . ", " .
    $_POST[$amount] . ", " .
    $_POST[$sub_total] . ")";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Query error: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
?>

<html>
<head>
    <title>7-Elephant</title>
</head>
<body style="text-align:center">
    <br /><br />
    <table border="0" cellspacing="0">
    <tr>
    <td colspan="4"><b><h2>Order Confirmation</h2>
    Your order has been submitted.</b><br />
    We will contact you when the products have been shipped.<br />
    For cancellation please contact sales@7elephant.com.
    Tel. 02-999-9999</td>
    </tr>
    </table>
    <br /><br />
</body>
</html>