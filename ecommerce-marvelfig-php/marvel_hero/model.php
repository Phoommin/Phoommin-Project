<?php
// session_start();
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

<body><center>
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
    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
         <div class="input-group">
	          <input type="text" class="form-control" placeholder="Search for...">
          	<span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Search!</button>
	      </div>
          <a href="#" class="list-group-item">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
	        <a href="#" class="list-group-item">Category 4</a>
	        <a href="#" class="list-group-item">Category 5</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="images/DSC_0800.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
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

        <form id="product" method="POST" action="order.php">
        <div class="row">
        <?php  
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              echo "<div class='col-lg-4 col-md-6 mb-4'>";
              echo "<div class='card h-100'>";
              echo "<a href='#'>";
              echo "<img class='card-img-top' src=\"images/".$row["name_img"]."\"/style='width:253px;height:300px;'>";
              echo "</a>";
              echo "<div class='card-body'>";
              echo "<h4 class='card-title'>";
              echo "<p>".$row['name_product']."<p>";
              echo "</h4>";
              echo "<h5>".$row['price'].'฿'."</h5>";
              echo "<p class='card-text'>".$row['size']."</p>";
              echo "</div>";
              echo "<div class='card-footer'>";
              // echo "<h4>ซื้อสินค้าติ้กที่ช่องนี้</h4>";
              // echo "<a href='cart.php'?product_id=$row[product_id]&act=add'><center> ซื้อสินค้า </center></a>";
              echo "<h6>ซื้อสินค้าติ้กที่ช่องนี้ &nbsp;&nbsp;<input type=\"checkbox\" name=\"buy[]\" value=\"" .$row['product_id'] . "\" /></h6>";
              // echo "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>";
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
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
  </div>
  <button type='submit'>สั่งซื้อสินค้า</button>
  <br/>
  <br/>
  <br/>
  <!-- /.container -->   
  <!-- Bootstrap core JavaScript -->
  <!-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  </center>
</body>
             <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>