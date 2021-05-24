<?php

require_once 'config.php';
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

<body>

<header>  <!-- Navigation -->
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
<br />
<br />
<br />
<div class="container">
<h3 class="my-4" align="center">Add Information Model</h3>
    <form name="from1" method="post" action="addmodel.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter 30 Characters">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Price</label>
        <input type="text" class="form-control" name="price" placeholder="50000 ฿">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Size</label>
        <input type="text" class="form-control" name="size" >
      </div>
      <!-- <div class="form-group">
        <label for="exampleInputPassword1">Amount</label>
        <input type="text" class="form-control" name="amount">
      </div> -->
      <div class="form-group">
        <label for="exampleFormControlFile1">Uploand Image 1</label>
        <input type="file" class="form-control-file" name="name_img">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
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
      echo "<th scope='col' style='text-align:center'>Product_id</th>";
      echo "<th scope='col' style='text-align:center'>Name Product</th>";
      echo "<th scope='col' style='text-align:center'>Name image</th>";
      echo "<th scope='col' style='text-align:center'>Price</th>";
      echo "<th scope='col' style='text-align:center'>Size</th>";
      echo "</tr>";
      echo "</thead>";
		
      
      $result = mysqli_query($conn, "SELECT * FROM product");
      $i=1;
      if(!$result) die('Query error: ' . mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)) {
          echo "<tbody>";
          echo	"<tr>";
          echo	"<th scope='row' style='text-align:center'>$i</th>";
          echo	"<td style='text-align:center'>".$row['product_id']."</td>";
          echo	"<td style='text-align:center'>".$row['name_product']."</td>";
          echo	"<td style='text-align:center'>".$row['name_img']."</td>";
          echo	"<td style='text-align:center'>".$row['price']."</td>";
          echo	"<td style='text-align:center'>".$row['size']."</td>";
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