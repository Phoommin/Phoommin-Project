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

  <title>Contect</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  
		
    <!-- Custom styles for this template -->
    

</head>
<br />
<br />
<body style="background-color:Black;">


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
     <!-- Page Content -->
     <div class="container">

<!-- Introduction Row -->
<h1 class="my-4"><font color="white">Contact
  <small>ช่องทางสำหรับติดต่อเรา</small>
</h1>
<p>กลุ่มที่ 7 นักศึกษาชั้นปีที่ 2 สำนักวิชาเทคโนโลยีสังคม สาขาวิชาเทคโนโลยีสารสนเทศ</p>

<!-- Team Members Row -->
<div class="row">
  <div class="col-lg-12">
    <h2 class="my-4">Our Team</h2>
  </div>

  <div class="col-lg-4 col-sm-6 text-center mb-4">
    <img class="rounded-circle img-fluid d-block mx-auto" src="images/jan.jpg"  style="width:200px;height:200px;">
    <h3>Nitirat Khudpab<br />
      <small>B6070168</small>
    </h3>
    <p>E-mail: janjan_5653@hotmail.com</p>
  </div>

  <div class="col-lg-4 col-sm-6 text-center mb-4">
  <img class="rounded-circle img-fluid d-block mx-auto" src="images/eak.jpg"  style="width:200px;height:200px;">
  <h3>Arkalerk Kitthimon<br />   
      <small>B6070212</small>
    </h3>
    <p>E-mail: arkalerk.5111.1998@gmail.com</p>
  </div>
  
  <div class="col-lg-4 col-sm-6 text-center mb-4">
  <img class="rounded-circle img-fluid d-block mx-auto" src="images/pai.jpg"  style="width:200px;height:200px;">
  <h3>Phoommin Naksenee<br />
      <small>B6070489</small>
    </h3>
    <p>E-mail: B6070489@g.sut.ac.th</p>
  </div>

  <div class="col-lg-4 col-sm-6 text-center mb-4">
  <img class="rounded-circle img-fluid d-block mx-auto" src="images/nut.jpg"  style="width:200px;height:200px;">
  <h3>Krissada Jenprakhon<br />
      <small>B6070601</small>
    </h3>
    <p>E-mail: nutamitydoom11@gmail.com</p>
  </div>

  <div class="col-lg-4 col-sm-6 text-center mb-4">
  <img class="rounded-circle img-fluid d-block mx-auto" src="images/bank.jpg"  style="width:200px;height:200px;">
    <h3>Narit Patimaporncha<br />
      <small>B6074890</small>
    </h3>
    <p>E-mail:npatimapornchai@gmai.com </p>
  </div>

</div>

</div>
<!-- /.container -->
</body>
           <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>