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
    </header>
    <br />   <br />   <br />   <br /> 
  <div class="container">
    <h3 class="my-4" align="center">Add Information Hero</h3>
    <form name="from1" method="post" action="addhero.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleInputEmail1">Name Hero</label>
        <input type="text" class="form-control" name="name_hero" placeholder="Name Hero">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Alias </label>
        <input type="text" class="form-control" name="alias" placeholder="Alias">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Birthdate</label>
        <input type="date" class="form-control" name="birthdate">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Species</label>
        <input type="text" class="form-control" name="species" placeholder="species">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Power</label>
        <textarea class="form-control" name="powers" rows="4"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Name_Action</label>
        <input type="text" class="form-control" name="name_action" placeholder="Name Actoin">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" rows="8"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Uploand Image 1</label>
        <input type="file" class="form-control-file" name="name_img">
        <label for="exampleFormControlFile1">Uploand Image 2</label>
        <input type="file" class="form-control-file" name="name_img2">
        <label for="exampleFormControlFile1">Uploand Image 3</label>
        <input type="file" class="form-control-file" name="name_img3">
        <label for="exampleFormControlFile1">Uploand Image 4</label>
        <input type="file" class="form-control-file" name="name_img4">
        <label for="exampleFormControlFile1">Uploand Image 5</label>
        <input type="file" class="form-control-file" name="name_img5">
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
</form>
</body>
         <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>