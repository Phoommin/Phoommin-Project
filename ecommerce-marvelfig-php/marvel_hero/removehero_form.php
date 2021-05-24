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

  <script type="text/javascript">
    function updateTotal() {
        var i = 0;
        var price = 0;
        var amount = 0;
        var name = "";
        var sub_total = 0;
        var grand_total = 0;
    for(i = 0;
    i < document.forms["product"].elements[
    "order_amount"].value; i++) {
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
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  
		
    <!-- Custom styles for this template -->
    

</head>

<body>
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
    <div class="container" >
    <h3 class="my-4" >Remove Information Hero</h3>
    <form class="needs-validation" novalidate method="post" action="removehero.php">
      <div class="form-row">
        <div class="col-md-6 mb-5">
          <label for="validationCustom01">ID_Hero</label>
          <input type="text" class="form-control" name="hero_id" id="validationCustom01" placeholder="ID">
          <div class="valid-feedback">
          </div>
        </div>
      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  </div>
  <br />
    <br />
    <br />
    <br />
    <?php
      echo "<div class='container'>";
      echo "<div class='span8'>";
      echo "<table class='table' border ='1'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th scope='col' style='text-align:center'>#</th>";
      echo "<th scope='col' style='text-align:center'>Hero_id</th>";
      echo "<th scope='col' style='text-align:center'>Name</th>";
      echo "<th scope='col' style='text-align:center'>Alias</th>";
      echo "<th scope='col' style='text-align:center'>Birthdate</th>";
      echo "<th scope='col' style='text-align:center'>Species</th>";
      echo "</tr>";
      echo "</thead>";
		
      
      $result = mysqli_query($conn, "SELECT * FROM tbl_character");
      $i=1;
      if(!$result) die('Query error: ' . mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)) {
          echo "<tbody>";
          echo	"<tr>";
          echo	"<th scope='row' style='text-align:center'>$i</th>";
          echo	"<td style='text-align:center'>".$row['hero_id']."</td>";
          echo	"<td style='text-align:center'>".$row['name_hero']."</td>";
          echo	"<td style='text-align:center'>".$row['alias']."</td>";
          echo	"<td style='text-align:center'>".$row['birthdate']."</td>";
          echo	"<td style='text-align:center'>".$row['species']."</td>";
          echo	"</tr>";
          echo "</tbody>";
      }
      echo "</table>";
      echo "</div>";
      echo "</div>";

      mysqli_close($conn); 

?>
  <br />
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