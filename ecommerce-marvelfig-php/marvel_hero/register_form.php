<?php
require_once 'config.php';
?>
<html>
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
	<h1 align="center">สมัครสมาชิก</h1>
<form name="from1" method="post" action="register.php">
<div class="container" >
  <div class="form-group">
    <label for="InputUsername">Username</label>
    <input type="Username" class="form-control" id="exampleInputUsername" aria-describedby="UsernameHelp" placeholder="Enter username" name="Username">
    <small id="UsernamelHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="Password">
  </div>
  
  <div class="form-group">
	  <label for="Inputname">Name</label>
      <input type="text" class="form-control" placeholder="Name" name="Name">
    </div>
 
   <div class="form-group">
	  <label for="Inputage">Age</label>
      <input type="text" class="form-control" placeholder="Age" name="Age">
    </div>
  
  
  <div class="form-group">
    <label for="inputbirthdate">Birthdate</label>
    <input type="date" class="form-control" id="inputbirthdate" placeholder="Birthdate" name="Birthdate">
  </div>
  
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Address" name="Address">
  </div>
  
    <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline1"  class="custom-control-input" name="Sex" value="Male">
    <label class="custom-control-label" for="customRadioInline1">Male</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline2"  class="custom-control-input" name="Sex" value="Female">
    <label class="custom-control-label" for="customRadioInline2">Female</label>
  </div>

<br />
  <center> <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</body>
</html>