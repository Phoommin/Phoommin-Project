<?php

require_once 'config.php';
if(!isset($_SESSION['Username'])) {
    header("location: login.php");  
  }
?>
\<html>
<head><title>7-Elephant</title><head>
<body><center>
    <h1>View Order Details</h1>
    <form name="form1" method="post" action="update_status.php">
    <?php
    $result = mysqli_query($conn,"SELECT * FROM order_buy, register WHERE
    order_buy.User_id = register.Users_id AND order_id = " .
    $_GET['order_id']);
    if (!$conn) die('Could not connect: ' . mysqli_error());
    $row = mysqli_fetch_array($result);
    echo "<b>Order#</b>" . $row['order_id'] .
    "<br /><b>Total: </b>" . $row['grand_total'] .
    "<br /><b>Order Date/Time: </b>" . $row['order_date'] .
    "<br /><b>Status: </b>" . $row['order_status'] . " ";
    ?>

    <select name="status">
    <option value="" />
    <option value="Processing" />Processing
    <option value="Shipped" />Shipped
    </select>
    <input type="submit" value="Update Status">

    <?php
    echo "<br /><br /><b>Customer Information:</b><br />" .
    $row['Name'] . "<br />" .
    $row['Address'] . " " . "<br />".
    //$row['phone_no'] .
    "<br /><b>Credit Card No#: </b>" .
    $row['card_no'];
    ?>
    <b><br /><br />
    Product#&nbsp;&nbsp;&nbsp; Name&nbsp;&nbsp;&nbsp;
    QTY&nbsp;&nbsp;&nbsp; Sub Total&nbsp;&nbsp;&nbsp;
    </b><br />
    
    <?php
    $result = mysqli_query($conn,"SELECT * FROM order_details, product
    WHERE order_details.product_id = product.product_id AND order_id = " .
    $_GET['order_id']);
    if (!$result) die('Could not connect: ' . mysqli_error($conn));
    while($row = mysqli_fetch_array($result)) {
    echo $row['product_id'] . " " . $row['name_product'] . " " . $row['size'] .
    " " . $row['amount'] . " " . $row['sub_total'] . " <br />" ;
    }
    mysqli_close($conn);
    ?>
    <br />
    <a href="view_orders.php">&lt Back</a>
    <center>
</body>
</html>
