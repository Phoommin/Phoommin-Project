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
        <link rel="icon" href="<?php echo asset('images/Logo.png'); ?>"/>
      <style>
        .bg-bluecolorheader {
            background: #7EC9C5 no-repeat padding-box;
        }
    </style>
        <title>Post</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
    <?php if(Session::get('email_admin') == null): ?>
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
 <?php else: ?>
 <a class="navbar-brand" href="#">
                            <img src="<?php echo e(asset('images/Logo.png')); ?>" width="100" height="50" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="<?php echo e(url('admin1')); ?>"><font color="white"><b>ผู้ใช้ที่ถูกรายงาน</b></font><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="<?php echo e(url('admin2')); ?>" ><b>อนุมัติอาจารย์</b></a>
                        </li>
                      </ul>
 <?php endif; ?>
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
                        }elseif(Session::get('email_admin') != null){
                          echo "&nbsp;&nbsp;&nbsp;";
                          echo "<div class='btn-group dropleft'>";
                          echo "<a class='btn btn-dark dropdown-toggle' data-toggle='dropdown' id='dropdownMenuLink' data-display='static' aria-haspopup='true' aria-expanded='false' >
                               <font color='white'>".Session::get('email_admin')."</font></a>";
                          echo "<div class='dropdown-menu'>";
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
    
<!-- Content -->
<br />
<div class="container">
<?php $__currentLoopData = $getPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="row">
    <div class="bg-bluecolorheader col-12">
        <h3 class="text-secondary"> <?php echo e($row->title); ?> </h3>
        <div class="row col-12">
            <h6 class="text-white"><?php echo e($row->category); ?> - <?php echo e($row->tags); ?> <?php echo e($row->date_time_post); ?> by<a href="<?php echo e(url('profiles',$row->id_user)); ?>" style="text-decoration: none; color:white;" title="ไปยังโปรไฟล์"> <?php echo e($row->firstname); ?> <?php echo e($row->lastname); ?></a></h6>
            <?php if($row->id_user == Session::get('id_user')): ?>
                <h6 class="text-white col text-right">
                    <a href="<?php echo e(route('edit',$row->id_post)); ?>" style="text-decoration: none; color: white;">แก้ไข</a> &nbsp; 
                    <a href="<?php echo e(url('delete_post',$row->id_post)); ?>" onclick="return confirm_del()" style="text-decoration: none; color: white;">ลบ</a>
                </h6>
            <?php elseif(Session::get('id_user') != null): ?>
                <h6 class="text-white col text-right">
                <?php if($check_report == false): ?>
                    <a href="<?php echo e(url('report_post',$row->id_post)); ?>" onclick="return reports()" style="text-decoration: none; color: white;">Report</a>
                <?php else: ?>
                    <b class="text-secondary">Reported</b>
                <?php endif; ?>
                </h6>
            <?php endif; ?>       
        </div> 
    </div>
  </div>
  <div class="row">
    <div class="alert alert-info col-12">
            <?php echo $row->message; ?> 
    </div>
  </div>
  <?php if(Session::get('id_user') != null): ?>
  <!--Form Input Your Answers-->
  <br />
  <div class="row">
    <h4>Answers</h4> 
  </div>
  <div class="row">
    <form class="form-inline border shadow-sm p-3 mb-5 bg-white rounded col-12" method="post" action="<?php echo e(url('insert_ans')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id_post" value="<?php echo e($row->id_post); ?>" />
        <textarea id="summernote" name="summernote" class="from-control"></textarea>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <input type="image" name="submit" src="<?php echo e(asset('images/icon_message.png')); ?>" alt="Submit" style="width: 45px;" />
    </form>
  </div>
  <!--/Form Input Your Answers-->
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--Answers-->
<?php $i = 1 ?>
<?php $__currentLoopData = $getAns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="row">
    &nbsp; &nbsp;
    <div class="row col-12 bg-light text-dark"> 
        <div class="col-8">
            <h5>Answers <?php echo $i++; ?>: 
            <?php if(Session::get('user_type')=='techer'): ?>
                <?php $__currentLoopData = $check_is_con; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($con->id_ans == $row2->id_ans): ?>
                        <img src="<?php echo e(asset('images/checked-checkbox1.png')); ?>" width="25" /><?php echo e($row2->firm); ?></h5>
                        <?php break; ?>
                    <?php elseif($loop->last): ?>
                        <a href="<?php echo e(url('confirm_ans',$row2->id_ans)); ?>" ><img src="<?php echo e(asset('images/icons8-checked-checkbox-80.png')); ?>" width="25" /></a><?php echo e($row2->firm); ?></h5>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
               <img src="<?php echo e(asset('images/success.png')); ?>" width="20" /> <?php echo e($row2->firm); ?></h5>
            <?php endif; ?>
        </div>
        <div class="col text-right">
            <h6><small><?php echo e($row2->date_time_ans); ?> by <a href="<?php echo e(url('profiles',$row->id_user)); ?>" style="text-decoration: none; color:black;" title="ไปยังโปรไฟล์"> <?php echo e($row2->firstname); ?> <?php echo e($row2->lastname); ?></a></small></h6>
        </div>
        <div class="col-12 alert alert-info">
            <?php echo $row2->message; ?>

        </div>
        <div class="row col-12 bg-light text-dark"> 
            <?php if($row2->id_user == Session::get('id_user')): ?>
                <a href="<?php echo e(url('form_edit_ans',$row2->id_ans)); ?>" style="text-decoration: none;">แก้ไข</a> &nbsp; 
                <a href="<?php echo e(url('delete_ans',$row2->id_ans)); ?>" style="text-decoration: none;" onclick="return confirm_ans_del()">ลบ</a>
            <?php endif; ?>
            <div class="col text-right">
            <?php if(Session::get('id_user') != null): ?>
              <?php if(!empty($check_like)): ?>
                  <?php $__currentLoopData = $check_like; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $like): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($like->id_ans == $row2->id_ans && $like->score == 1): ?>
                          <img src="<?php echo e(asset('images/like.png')); ?>" width="25"/><?php echo e($row2->v_like); ?> &nbsp;
                          <a href="<?php echo e(url('update_dislike_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-down.png')); ?>" width="25"/></a><?php echo e($row2->v_dislike); ?>

                          <?php break; ?>
                      <?php elseif($like->id_ans == $row2->id_ans && $like->score == -1): ?>
                          <a href="<?php echo e(url('update_like_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-up.png')); ?>" width="25"/></a><?php echo e($row2->v_like); ?> &nbsp;
                          <img src="<?php echo e(asset('images/dislike.png')); ?>" width="25"/><?php echo e($row2->v_dislike); ?>

                          <?php break; ?>
                      <?php elseif($loop->last): ?>
                          <a href="<?php echo e(url('like_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-up.png')); ?>" width="25"/></a><?php echo e($row2->v_like); ?> &nbsp;
                          <a href="<?php echo e(url('dislike_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-down.png')); ?>" width="25"/></a><?php echo e($row2->v_dislike); ?>

                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <a href="<?php echo e(url('like_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-up.png')); ?>" width="25"/></a><?php echo e($row2->v_like); ?> &nbsp;
                  <a href="<?php echo e(url('dislike_ans',$row2->id_ans)); ?>"><img src="<?php echo e(asset('images/thumbs-down.png')); ?>" width="25"/></a><?php echo e($row2->v_dislike); ?>

                <?php endif; ?>
                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <a data-toggle="collapse" href="#collapse<?php echo e($row2->id_ans); ?>" aria-expanded="false" aria-controls="<?php echo e($row2->id_ans); ?>" style="text-decoration: none;">show more comment</a>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#comment<?php echo e($row2->id_ans); ?>"> Reply </button>   
            <?php else: ?>
                <img src="<?php echo e(asset('images/thumbs-up-gray.png')); ?>" width="25"/><?php echo e($row2->v_like); ?> &nbsp;
                <img src="<?php echo e(asset('images/thumbs-down-gray.png')); ?>" width="25"/><?php echo e($row2->v_dislike); ?>

                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <a data-toggle="collapse" href="#collapse<?php echo e($row2->id_ans); ?>" aria-expanded="false" aria-controls="<?php echo e($row2->id_ans); ?>" style="text-decoration: none;">show more comment</a>   
            <?php endif; ?>
            </div>
        </div>

        <div class="row col-12 bg-light text-dark">
            <div class="collapse multi-collapse" id="collapse<?php echo e($row2->id_ans); ?>">
                <ul class="media-list">
                  <!--Comment-->
            <?php $__currentLoopData = $getCom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($row3->id_ans == $row2->id_ans): ?>
                    <li class="media media-replied">
                        <div class="media-body">
                            <div class="well well-lg">
                                <h6><b><a href="<?php echo e(url('profiles',$row3->id_user)); ?>" style="text-decoration: none; color:black;" title="ไปยังโปรไฟล์"> <?php echo e($row3->firstname); ?> <?php echo e($row3->lastname); ?></a></b></h6>
                                <p class="media-comment"><?php echo e($row3->message); ?></p>
                            </div>              
                        </div>
                    </li>
                    <!--/Comment-->
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>  
            </div>
        </div>
    </div>
  </div>
  <br />
  <!--/Answers-->
  <!--pop-up comment-->
<div class="modal fade" id="comment<?php echo e($row2->id_ans); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Form input Comment -->
      <form method="post" action="<?php echo e(url('comments')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id_ans" value="<?php echo e($row2->id_ans); ?>" />
        <div class="modal-body">
            <textarea name="com" placeholder="Comment..." rows="5" cols="62" style="border: none; resize: none;"></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send <img src="<?php echo e(asset('images/icon_message.png')); ?>" style="width: 20px;" /></button>
        </div>
      </form>
      <!-- /Form input Comment -->
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
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
<script> 
    function myFunction() {
        var txt;
        var r = confirm("ํYou sure to logout");
        if (r == true) {
            return true;
        }else 
        {
            return false;
        }
    }
    function confirm_del()  {   
        return confirm("คุณต้องการลบกระทู้นี้หรือไม่");
    }
    function confirm_ans_del(){
        return confirm("คุณต้องการลบคำตอบนี้หรือไม่");
    } 
    function reports(){
        return confirm("คุณต้องการรายงานกระทู้ที่นี้หรือไม่");
    }

    $(document).ready(function(){
          $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            placeholder: 'เขียนเนื้อหาของคุณ...',
            tabsize: 2,
            height: 300,
            width: 1020
          })
    });
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/view_post.blade.php ENDPATH**/ ?>