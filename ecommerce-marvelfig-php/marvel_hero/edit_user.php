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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
		
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
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Hero
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="addhero_form.php">Add Hero</a>
          <a class="dropdown-item" href="removehero_form.php">Remove Hero</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Model
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="addmodel_form.php">Add Model</a>
          <a class="dropdown-item" href="removemodel_form.php">Remove Model</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="checkstock.php">Check Stock</a>
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
<br />
<br />
<br />
<div class="container" >
<div class="row">
  <div class="col-lg-12">
  <div class="col-lg-4 col-sm-4 text-center mb-4">
  <form action=update.php name=edit_user method="post">
  <div class="form-group">
    <label>Name </label>
    <input name="Name" type="text" class="form-control" id="entername" placeholder="Enter name">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Age</label>
    <input name="Age" type="text" class="form-control" id="enterage" placeholder="Enter age">
  </div>
  <div class="form-group">
    <label class="form-check-label" for="enteraddress">Address </label>
    <input name="Address" type="text" class="form-control" id="enteraddress" placeholder="Enter address">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div> </div></div></div>
<br />
<br />
<br />
	<!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
    </div>
    <!-- /.container -->
  </footer>
  
</body>
           <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>