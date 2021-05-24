<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
        <link rel="shortcut icon" href="images/Logo.png" />
      <style>
        .bg-bluecolorheader {
            background: #7EC9C5 no-repeat padding-box;
        }
    </style>
        <title>Contact</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
                    <a class="navbar-brand" href="<?php echo e(url('home')); ?>">
                            <img src="<?php echo e(asset('images/Logo.png')); ?>" width="100" height="40" alt="">
                          </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="<?php echo e(url('Contact')); ?>">Contact<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="<?php echo e(url('About_us')); ?>" >About us</a>
                        </li>
                        <li class="nav-item dropdown active">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Post
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(url('home/allpost')); ?>">All POST</a>
                            <a class="dropdown-item" href="<?php echo e(url('general')); ?>">General</a>
                            <a class="dropdown-item" href="<?php echo e(url('math')); ?>">Mathematics</a>
                            <a class="dropdown-item" href="<?php echo e(url('science')); ?>">Science</a>
                            <a class="dropdown-item" href="<?php echo e(url('social')); ?>">Social</a>
                            <a class="dropdown-item" href="<?php echo e(url('language')); ?>">Language</a>
                            <a class="dropdown-item" href="<?php echo e(url('arts')); ?>">Arts</a>
                          </div>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <font color="white">CretePost</font>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(url('showpost')); ?>">เขียนกระทู้</a>
                            <a class="dropdown-item" href="<?php echo e(url('showarticle')); ?>">เขียนบทความ</a>
                          </div>
                        </li> 
                      </ul>
                      
                      <div class="col-6">
                          <div id="custom-search-input">
                          <form method="post" action="<?php echo e(url('search_result')); ?>">
                          <?php echo e(csrf_field()); ?>

                              <div class="input-group">
                                  <select  name="list_result" id="list_result" onclick="srmethod(this.value)">
                                      <option value="name">name</option>
                                      <option value="title" selected>title</option>
                                  </select>
                                  <input id="search" name="search" type="text" class="form-control" placeholder="Search" autofocus="on" required />&nbsp;&nbsp;
                                  <input type="image" src="<?php echo e(asset('images\white-search-icon-png-27@2x.png')); ?>" height="35px" alt="Submit">
                              </div>
                              </form>
                          </div>
                      </div>
                  
                      <form class="form-group" method="post" action="<?php echo e(url('login_c')); ?>">
                        <?php echo csrf_field(); ?>
                      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header text-center">
                              <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body mx-3">
                              <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <input type="text" name="u" id="defaultForm-email" class="form-control validate" placeholder="Email" > 
                              </div>

                              <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" name="p" id="defaultForm-pass" class="form-control validate" placeholder="Password">
                              </div>

                            </div>
                              <div class="modal-footer d-flex justify-content-center">
                              <input class="btn btn-warning" type="submit" value="login">
                            </div>
                          </div>
                        </div>
                    </div>
                    </form>
                      <?php
                      $name = Session::get('email');
                      $name = Str::limit($name, 25);
                      $id = Session::get('id_user');
                        if($name != null){
                          echo "&nbsp;&nbsp;&nbsp;";
                          echo "<div class='btn-group dropleft'>";
                          echo "<a class='btn btn-dark dropdown-toggle' data-toggle='dropdown' id='dropdownMenuLink' data-display='static' aria-haspopup='true' aria-expanded='false' >
                               <font color='white'>$name</font></a>";
                          echo "<div class='dropdown-menu'>";
                          echo "<a class='dropdown-item' href='"; ?><?php echo e(url('profile')); ?> <?php echo "'>Profile</a>";
                          echo "<a class='dropdown-item' onclick='return myFunction()' href='"; ?><?php echo e(url('Logout')); ?> <?php echo "'>Logout</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                        }else{
                        echo "<a class='nav-link' href='#' data-toggle='modal' data-target='#modalLoginForm'  data-whatever='@mdo' style='color:black;'>Login</a>";
                        echo "<a class='btn btn-light my-2 my-sm-0' type='button' href='"; ?><?php echo e(url('register')); ?> <?php echo "'>Sign up</a>";
                        echo "</form>";
                        }
                        ?>
                    </div>
                  </nav>
                  <?php if(session('alert')): ?>
                    <?php echo session('alert'); ?>

                    <?php Session::flush(); ?>
                  <?php endif; ?>
		
		<!-- Full Page Intro -->
          <div class="view" style="background-image: url('https://www.ehotelsasia.com/wp-content/uploads/2018/10/Black-Background-DX58.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  <div class="col-md-12 mb-4 white-text text-center">
                    <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s" style="color:white;"><strong>Contact</strong></h1>
                    <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                    <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s" style="color:white;"><strong>Contact to Admin & Developer Team</strong></h5>
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
          <!-- Full Page Intro -->
        </header>
        <!-- Main navigation -->
        <!--Main Layout-->
        <main>
          <div class="container">
            <!--Grid row-->
            <div class="row py-5">
              <!--Grid column-->
              <div class="col-md-12 text-center">
				  
               <img src="https://lh5.googleusercontent.com/proxy/w4syCQ1_ydCiHbbfg3Hvnb1BEDEE0l5DodXyx2sp_pu6qMfN5fcR5R0RRJ7BS2AhygGKYJvm4MXbRgwLLMtYfbLyiuUbhavRolQharH3AnD6vjAyb1sj=s0-d" style="width: 5%"> 044 223 000
				  <img src="https://sv1.picz.in.th/images/2020/01/13/RZtLfR.png" style="width: 5%"> Sut@gmail.com <br><br>
				  <img src="https://cdn.imgbin.com/3/21/2/imgbin-green-map-red-location-mark-d7dNEcvYXpHN69GR3rWdyz8h1.jpg" style="width: 10%"><br><br>
				  <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15423.964728068338!2d102.0206962!3d14.8817715!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x10533e4b3f07a09f!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li14Liq4Li44Lij4LiZ4Liy4Lij4Li1!5e0!3m2!1sth!2sth!4v1578327146170!5m2!1sth!2sth" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>

<!--Google Maps-->
				</div>
              </div>
              </div>
             
        </main>
        <!--Main Layout-->

        <script>
    var s = document.getElementById("list_result").value;              
    window.srmethod(s);

    function srmethod($strSearch){
        $(document).ready(function(){
        if($strSearch == "name" && $strSearch != null){

            $( "#search" ).autocomplete({

                source: function(request, response) {
                    $.ajax({
                    url: "<?php echo e(url('autocompleteName')); ?>",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                    success: function(data){
                    var resp = $.map(data,function(obj){
                            //console.log(obj.city_name);
                            name = obj.firstname + " " + obj.lastname;
                            return name;
                    });

                    response(resp);
                    }
                });
            },
            minLength: 1
        });

        }else{

            $( "#search" ).autocomplete({

                source: function(request, response) {
                    $.ajax({
                    url: "<?php echo e(url('autocompleteTitle')); ?>",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                    success: function(data){
                    var resp = $.map(data,function(obj){
                            //console.log(obj.city_name);
                            name = obj.title;
                            return name;
                    });

                    response(resp);
                    }
                });
            },
                minLength: 1
            });


        }
    });}
  </script>
    </body>
</html>
</body>
</html><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/Contact.blade.php ENDPATH**/ ?>