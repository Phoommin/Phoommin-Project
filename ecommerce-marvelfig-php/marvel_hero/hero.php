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
    <!-- Page Content -->
    <div class="container">
	
      <!-- Page Heading -->
      <h1 class="my-4">Page Heading
        <small>Secondary Text</small>
      </h1>
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Search for...">
	<span class="input-group-btn">
         	<button class="btn btn-secondary" type="button">Search!</button>
	  </div>
	<br />
      <div class="row">
        <?php  
        $sql = "SELECT * FROM tbl_character";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-lg-4'>";
                echo "<div class='card mb-2'>";
                echo "<img class='card-img-top' src=\"images/".$row["name_img"]."\"/style='width:100%;height:100%;'>";
                // style='width:349px;height:300px;'
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>".$row['name_hero']."</h5>";
                echo "<ul>";
                echo "<li>".'Birthdate'.$row['birthdate']."</li>";
                echo "<li>".'Birthdate'.$row['species']."</li>";
                echo "<li>".'Birthdate'.$row['alias']."</li>";
                echo "</ul>";
                echo "<a href='information.php?hero_id=$row[hero_id]' class='btn btn-primary'>Go somewhere</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        
        ?>
      </div>
      <!-- /.row -->
    <!-- Pagination
    <ul class="pagination justify-content-center">
        
        <li class="page-item">
          <a class="page-link" href="hero.php">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="hero2.php">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="hero3.php">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="hero6.php" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul> -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>