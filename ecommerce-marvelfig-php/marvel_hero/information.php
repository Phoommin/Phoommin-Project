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
    <?php
          $sql = "SELECT * FROM tbl_character  WHERE  hero_id = '".$_GET['hero_id']."'";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {

              echo"<!-- Page Content -->";
              echo"<div class='container'> ";
              echo"<!-- Portfolio Item Heading -->";
              echo"<h1 class='my-4'>Page Heading";
              echo"<small>Secondary Text</small>";
              echo"</h1>";

              echo"<div class='row'>";
              echo "<div class='col-md-8'>";
              echo "<img class='img-fluid' src=\"images/".$row["name_img"]."\"/style='width:100%;height:100%;'>";
              echo "</div>";
              echo "<div class='col-md-4'>";
              echo "<h3 cs='my-3'>".$row['name_hero']."</h3>";
              echo "<p>".$row['powers']."</p>";
              echo "<h3 class='my-3'>About Hero</h3>";
              echo "<ul>";
              echo "<li>".'Birthdate'.$row['birthdate']."</li>";
              echo "<li>".'Birthdate'.$row['species']."</li>";
              echo "<li>".'Birthdate'.$row['alias']."</li>";
              echo "<li>".'Birthdate'.$row['name_action']."</li>";
              echo "</ul>";
              echo "</div>";
              echo "</div>";
              echo"<br />";
              echo"<h3 class='my-4'>Related Projects</h3>";

              echo"<div class='row'>";

              echo"<div class='col-md-3 col-sm-6 mb-4'>";
              echo"<a href='#'>";
              echo "<img class='img-fluid' src=\"images/".$row["name_img2"]."\"/style='width:100%;height:100%;'>";
              echo"</a>";
              echo"</div>";

              echo"<div class='col-md-3 col-sm-6 mb-4'>";
              echo"<a href='#'>";
              echo"<img class='img-fluid' src=\"images/".$row["name_img3"]."\"/style='width:100%;height:100%;'>";
              echo"</a>";
              echo"</div>";

              echo"<div class='col-md-3 col-sm-6 mb-4'>";
              echo"<a href='#'>";
              echo "<img class='img-fluid' src=\"images/".$row["name_img4"]."\"/style='width:100%;height:100%;'>";
              echo"</a>";
              echo"</div>";

              echo"<div class='col-md-3 col-sm-6 mb-4'>";
              echo"<a href='#'>";
              echo "<img class='img-fluid' src=\"images/".$row["name_img5"]."\"/style='width:100%;height:100%;'>";
              echo "</a>";
              echo"</div>";
              echo "<h3 cs='my-3'>".$row['name_hero']."</h3>";
              echo "<p>".$row['description']."</p>";
              echo"</div>";
              echo"</div>";
            }
          } else {
              echo "0 results";
          }
      ?>        
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