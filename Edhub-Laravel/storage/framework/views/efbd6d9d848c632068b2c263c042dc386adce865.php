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
        <title>About Us</title>
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

                  <script>
              // If user clicks anywhere outside of the modal, Modal will close
              var modal = document.getElementById('modal-wrapper');
              window.onclick = function(event) {
                if (event.target == modal) {
                  modal.style.display = "none";
                }
              }
              </script>
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
                    <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s" style="color:white;"><strong>About Us</strong></h1>
                    <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                    <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s" style="color:white;" ><strong>About Admin & Developer Team</strong></h5>
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
			<style>
.hovereffect {
  width: 100%;
  height: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: default;
}

.hovereffect .overlay {
  position: absolute;
  overflow: hidden;
  width: 80%;
  height: 80%;
  left: 10%;
  top: 10%;
  border-bottom: 1px solid #FFF;
  border-top: 1px solid #FFF;
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: scale(0,1);
  -ms-transform: scale(0,1);
  transform: scale(0,1);
}

.hovereffect:hover .overlay {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.hovereffect img {
  display: block;
  position: relative;
  -webkit-transition: all 0.35s;
  transition: all 0.35s;
}

.hovereffect:hover img {
  filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feComponentTransfer color-interpolation-filters="sRGB"><feFuncR type="linear" slope="0.6" /><feFuncG type="linear" slope="0.6" /><feFuncB type="linear" slope="0.6" /></feComponentTransfer></filter></svg>#filter');
  filter: brightness(0.6);
  -webkit-filter: brightness(0.6);
}

.hovereffect h2 {
  text-transform: uppercase;
  text-align: center;
  position: relative;
  font-size: 17px;
  background-color: transparent;
  color: #FFF;
  padding: 1em 0;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(0,-100%,0);
  transform: translate3d(0,-100%,0);
}

.hovereffect a, .hovereffect p {
  color: #FFF;
  padding: 1em 0;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(0,100%,0);
  transform: translate3d(0,100%,0);
}

.hovereffect:hover a, .hovereffect:hover p, .hovereffect:hover h2 {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}
</style>
          <div class="container">
            <!--Grid row-->
            <div class="row py-5">
              <!--Grid column-->
             <div class="d-flex justify-content-around">
				 
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="hovereffect">
							<img class="img-responsive" src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.0-1/c0.0.640.640a/79950322_552332851986645_7978092869774737408_n.jpg?_nc_cat=106&_nc_eui2=AeGWeWSZ8Cl9PLCAAC3HWH6lsocniXCuNhjDJF2nVbtwkOo9DL7_hrNNN8qqd9xBexuzH1wUpA2Xpy3P5smcMr8TxFVUp-pG03WDRSPkga_0eQ&_nc_ohc=bX_C4IgAxmEAQkrJT8ssg6o3u5-9KhYQ-8ivvy2s5DhAvxlbwTQy-tTkw&_nc_ht=scontent.fbkk5-8.fna&oh=3396c9218547817f829428b06f7cf7ca&oe=5E9169AE" alt="" style="width:100%">
								<div class="overlay">
									<h2>นายภูมิมินทร์ นาคเสนีย์</h2>
									<p>
										<a>B6070489</a>
									</p>
								</div>
						</div>
					</div>					 
				  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="hovereffect">
							<img class="img-responsive" src="https://scontent.fbkk5-3.fna.fbcdn.net/v/t1.0-9/p960x960/44779494_1720726461371336_6719566447300837376_o.jpg?_nc_cat=111&_nc_eui2=AeGjYwTeApMXjbDQB9rhr9MJDfU1h3UtO8AwZ9ND75wRAeYgzPXbQDBzqQB-bzGbsMDSv7pmtOUUjJa8SLrqOZGnOeXc-SjkgmNhJocF2WumiA&_nc_ohc=wdA_SFBeG5sAQk9oZ8cVGvwYbZtT_qHbh5FzOX2ZQNVFfLycGEG4kliaw&_nc_ht=scontent.fbkk5-3.fna&oh=22ae3d17949a5d40d349232480ecde48&oe=5E9100E0" alt="" style="width:100%">
								<div class="overlay">
									<h2> นายนนทวัฒน์ จวนประเสริฐ</h2>
									<p>
										<a> B6073947</a>
									</p>
								</div>
						</div>
					</div>			  
				   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="hovereffect">
							<img class="img-responsive" src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t31.0-8/p960x960/14444847_193069761125763_3547561746766589886_o.jpg?_nc_cat=100&_nc_eui2=AeGzCYzf9kboskdFFgoPQ9U-g69Xk1Ru0nLrnY76DJ0QqGW7JD6Ox3BTb44jmHTUkmYSNgEslvGL-R-c_a2qcwAZ6Kkj7K8Iq4iqGFhrVXxSyA&_nc_ohc=y6vgZC1jiSIAQmgRdoNassJ43o6KrM2AC9eVXNAmvjtalgUGjtM21dtPQ&_nc_ht=scontent.fbkk5-5.fna&oh=ce3eff5306e19c07b02cfd97a5550af0&oe=5EAEECA9" alt="" style="width:100%">
								<div class="overlay">
									<h2>  นายเอกฤกษ์ กิจธิมน </h2>
									<p>
										<a> B6070212	</a>
									</p>
								</div>
						</div>
					</div>		
					 </div>
           <br>
			  <div class="d-flex justify-content-around">	
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="hovereffect">
						  <img class="img-responsive" src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t1.0-9/p960x960/81401314_3349819225092198_6206437951304368128_o.jpg?_nc_cat=104&_nc_eui2=AeE_Znc_3RzsNso-kMY2AuERtrs7Z_XIyiVtrB3j8dKr8HkdJ-kCDWxZwS6Ty-GwwVH8jynpomuICNulxAE3zkhwxZbnhWl8LoUJ_KfFMtreEw&_nc_ohc=ODBG0A3q1doAQnUzyTzNTSEe19LMWjV_W5MruzQY0TTncOB-7Fk2pO9Jw&_nc_ht=scontent.fbkk5-7.fna&oh=aa8cacfb63cc4477cf7032c131e2fa3c&oe=5E905F0C" alt="" style="width:100%">	
							<div class="overlay">
									<h2>  นายชยุตม์ โคตรพงษ์ </h2>
									<p>
										<a> B6071028	</a>
									</p>
								</div>
					</div>
			    </div>
			    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="hovereffect">
						  <img class="img-responsive" src="https://scontent.fbkk5-6.fna.fbcdn.net/v/t1.0-9/p960x960/65075864_453720895192595_8684034228783939584_o.jpg?_nc_cat=102&_nc_eui2=AeEWwS2N-zsQJQbf07DhwKl3R8QJwFPGwtNckOkcl6xwtb27O2ewf42gz6N-URHTZhstE0Ge3Q2eGBdNxkOkakyTue2OzVRZtoRNLoVjTjE7ZQ&_nc_ohc=hBS8mpGIyPQAQnMBtOw1C6BGiPob7L3DwDlNXnLocv1iEbbJy3BQSRsHQ&_nc_ht=scontent.fbkk5-6.fna&oh=e1d5c901b7a56471e556d7d8c78eb052&oe=5EAF982E" alt="" style="width:100%">
						  <div class="overlay">
									<h2>  นายอธิษฐาน เรืองฤทธิ์ </h2>
									<p>
										<a> B6071028	</a>
									</p>
								</div>
						</div>
				  </div>
				  &nbsp;
				  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					  <div class="hovereffect">
						<img class="img-responsive" src="https://scontent.fbkk5-2.fna.fbcdn.net/v/t1.0-9/p960x960/72634753_2423110831136167_2670374162278645760_o.jpg?_nc_cat=108&_nc_eui2=AeEyAxmCvjN3NZxsoIBHuXp0xYVPqpY4llgEPTtpsHTQQOgbxdkPuxHme5lNzIq2ziwTnikbsxkYFJEwA3qztyeBULD5HUhZuLp5pTfceYsHDA&_nc_ohc=9sSNTS40THIAQnglfU-Jw-qdv7GPqERAr7sEybGM7c-8og2KnztjknRRA&_nc_ht=scontent.fbkk5-2.fna&oh=13ec95ca28f8caf448752dc9cae23571&oe=5E684452" alt="" style="width:100%">
								<div class="overlay">
									<h2>  นายพัชร กกสูงเนิน  </h2>
									<p>
										<a>  B6070236	</a>
									</p>
								</div>
					</div>
			    </div>
				  &nbsp;</div>
				 
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
</html><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/About_us.blade.php ENDPATH**/ ?>