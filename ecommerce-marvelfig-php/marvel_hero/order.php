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
  
  <script type="text/javascript">
    function updateTotal() {
        var i = 0;
        var price = 0;
        var amount = 0;
        var name = "";
        var sub_total = 0;
        var grand_total = 0;
    for(i = 0;i < document.forms["product"].elements["order_amount"].value; i++) {

        price = document.forms["product"].elements["price" + i].value;
        amount = document.forms["product"].elements["amount" + i].value;
        sub_total = price * amount;
        document.forms["product"].elements["sub_total" + i].value = sub_total;
        grand_total += sub_total;
    }
    document.forms["product"].elements["grand_total"].value = grand_total;
    }
    function jump() {
        document.forms["product"].elements["submit"].focus();
    }
    </script>

  <title>Shop Homepage - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- Navigation -->
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
            <a class="nav-link" href="index.php">Homepage</a>
            </form>
          </li>
          <li class="nav-item" >
            <a class="nav-link" href="hero.php">Hero</a>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="model.php">Model</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
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
    </div>
  </nav>
	<br />
	<br />
	<br />
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/wp1829345.jpg" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="images/wp1829345.jpg" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="images/wp1829345.jpg" class="d-block w-100">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </header>
<br />
<br />
<br />
<div class="container" >
<form id="product" method="POST" action="place_order.php">
<td colspan="4"><h3><b>Place Order<br />
    Please enter desired quantity to buy then click
    "Place Order"<h3></b></td>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <!-- <th scope="col">Number</th> -->
      <th scope="col" style="text-align:center">Pictuce</th>
      <th scope="col" style="text-align:center">Product Name</th>
      <th scope="col" style="text-align:center">Price</th>
      <th scope="col" style="text-align:center">Quantity</th>
      <th scope="col" style="text-align:center">Subtotal</th>
    </tr>
  </thead>
  <?php 

        $product_list = implode(",", $_POST["buy"]);
        // $con = mysql_connect("localhost","root","");
        // if (!$con) die('Could not connect: ' . mysql_error());
        // mysql_select_db("seven_elephant", $con);
        
        $result = mysqli_query($conn, "SELECT * FROM product WHERE product_id IN (".$product_list.")");
        if (!$result) die('Error query: ' . mysqli_error($conn));
        $i = 0;  
        $j = 0;
        $grand_total = 0;
        // $i = 0;
        // $grand_total = 0;
        // $sql = "SELECT * FROM product";
        // $result = mysqli_query($conn, $sql);
        
            // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        echo "<tbody>"; 
        // echo	"<th scope='row' style='text-align:center'>$i</th>";
        echo  "<tr><input type=\"hidden\" name=\"product_id" .$i . "\" value=\"" . $row['product_id'] ."\" />";
        // echo "<th scope='row'></th>";
        echo "<td><align=\"center\"><img src=\"images/" .$row['name_img'] ."\"/style='width:150px;height:150px;'></td>";
        echo "<td>" . $row['name_product'] . "</td>";
        echo "<td><input type=\"text\"style=\"text-align:right\" onfocus=\"jump()\"name=\"price" . $i . "\" value=\"" .$row['price'] . "\" /></td>";
        echo "<td><input type=\"text\"style=\"text-align:right\" size=\"5\"name=\"amount" . $i . "\" value=\"1\" /></td>";
        echo "<td><input type=\"text\"style=\"text-align:right\" onfocus=\"jump()\"name=\"sub_total" . $i . "\" value=\"" .$row['price'] . "\" /></td>";
        echo "</tr>";
        echo "</tbody>";
        $i++;
        $grand_total += $row['price'];
            }
            echo "<input type=\"hidden\" name=\"order_amount\" value=\"" .$i . "\" />";
        ?>

        <tr>
        <td colspan="4" align="right"><b>Grand Total:</b></td>
        <td><input type="text" style="text-align:right"
        onfocus="jump()" name="grand_total" value="" /></td>
        </tr>
        </table>
        <br />
        <b>Your information:</b><br />
        <?php
        $result = mysqli_query($conn,"SELECT * FROM register WHERE Users_id = ".$_SESSION['Users_id']);
        if (!$conn) die('Could not connect: '. mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        echo $row['Name'] . "<br />" . $row['Address'];
        // mysqli_close($conn);
        // ."<br />Tel." . $row['phone_no']
        ?>
        <br />
        <br />
        Please enter credit card number:
        <input type="text" name="card_no" size="30" />
        <br /><br />
        <input type="button" name="update_total"value="Update Total" onClick="updateTotal()" />
        <input type="submit" name="submit" value="Place Order" />
        <br /><br />
        
        </form>
        </div>
    <br />
    <br />
    <br />

</body>
               <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>