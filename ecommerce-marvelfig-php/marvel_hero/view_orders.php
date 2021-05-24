<?php

require_once 'config.php';
if(!isset($_SESSION['Username'])) {
    header("location: login.php");  
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  
		
    <!-- Custom styles for this template -->
    

</head>

<body><center>
<header>  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index_admin.php">Homepage</a>
          </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Hero
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="addhero_form.php">Add Hero</a>
          <a class="dropdown-item" href="removehero_form.php">Remove Hero</a>
          <a class="dropdown-item" href="updatehero_form.php">Update Hero</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Model
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="addmodel_form.php">Add Model</a>
          <a class="dropdown-item" href="removemodel_form.php">Remove Model</a>
          <a class="dropdown-item" href="updatemodel_form.php">Update Model</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="view_orders.php">Veiw Order</a>
        </div>
      </li>
        </ul>
        <?php
        if(isset($_SESSION['Username'])){
          echo "<span style='color:white;'>".$_SESSION['Username']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
          echo "<a href='checklogout.php'>logout</a>";
        }else{
          echo "<form  action='Login.php' class='form-inline my-2 my-lg-0'>";
          echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Login</button>";
          echo "</form>";
        }
        ?>
    </div>
  </nav>
	 </header>
     <br />
  <br />
  <br />
  <br />
    <h1>View Orders</h1><b>
    <div class='container'>
    <div class='span8'>
    <table class='table' border = "1">
    <thead>
        <tr>
        <!-- <th scope="col">Number</th> -->
        <th scope="col" style='text-align:center'>Order</th>
        <th scope="col" style='text-align:center'>Customer</th>
        <th scope="col" style='text-align:center'>Total</th>
        <th scope="col" style='text-align:center'> Order Date/Time</th>
        <th scope="col" style='text-align:center'>Status</th>
        </tr>
    </thead>
    <?php
    $result = mysqli_query($conn, "SELECT order_id, name, grand_total, order_date,
    order_status FROM order_buy, register WHERE order_buy.User_id =
    register.Users_id");
    if (!$conn) die('Could not connect: ' . mysqli_error($conn));
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" .$row['order_id'] . "&nbsp;&nbsp;&nbsp;" ."</td>";
        echo "<td>" .$row['name'] . "&nbsp;&nbsp;&nbsp;<b>" ."</td>";
        echo "<td>" .$row['grand_total'] . "</b>&nbsp;&nbsp;&nbsp;" ."</td>";
        echo "<td>" .$row['order_date'] . "&nbsp;&nbsp;&nbsp;<b>" ."</td>";
        echo "<td>" .$row['order_status'] . "</b>&nbsp;&nbsp;&nbsp;"."</td>";
        echo "<td><a href=\"view_orders_details.php?order_id=" . $row['order_id'] ."\">View Order Details</a><br /></td>";
        echo "</tr>";
    }
    mysqli_close($conn);
    ?>
    </table>
    </div> 
    </div>
    </center>
    <br />
  <br />
  <br />
  <br />
	<!-- Footer -->
</body>
<footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
    </div>
    <!-- /.container -->
  </footer>
</html>
