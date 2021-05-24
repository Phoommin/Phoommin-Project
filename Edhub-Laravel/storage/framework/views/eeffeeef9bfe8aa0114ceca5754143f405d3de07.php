<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>HOME</title>
    </head>
    <body>    
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
            <a class="navbar-brand" href="#">
              <img src="<?php echo e(asset('images/Logo.png')); ?>" width="100" height="40" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Contact<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#" >About us</a>
                </li>
                <li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Post</a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">All POST</a>
                    <a class="dropdown-item" href="#">Mathematics</a>
                    <a class="dropdown-item" href="#">Science</a>
                    <a class="dropdown-item" href="#">Social</a>
                    <a class="dropdown-item" href="#">Language</a>
                    <a class="dropdown-item" href="#">Arts</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <font color="white">CretePost</font>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/showpost">เขียนกระทู้</a>
                    <a class="dropdown-item" href="/showarticle">เขียนบทความ</a>
                  </div>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <input type="image" src="<?php echo e(asset('images\white-search-icon-png-27.png')); ?>" alt="Submit">
              </form>
          
              <?php
                if(isset($_SESSION['Username'])){
                echo "&nbsp;&nbsp;&nbsp;";
                echo "<div class='dropdown'>";
                echo "<a class='dropdown-toggle' data-toggle='dropdown' data-display='static' aria-haspopup='true' aria-expanded='false' >".$_SESSION['Username'].
                "</a>";
                echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-lg-right'>";
                echo "<button class='dropdown-item' type='button'>Profile</button>";
                echo "<button class='dropdown-item' type='button'>My Post</button>";
                echo "<button class='dropdown-item' type='button'>Logout</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                }else{
                echo "<a class='nav-link' href='#' style='color:black;'>Login</a>";
                echo "<button class='btn btn-light my-2 my-sm-0' type='submit'>Sign up</button>";
                echo "</form>";
                }
              ?>
            </div>
        </nav>

        <div class="container">
            <br>
            <img src="images/Home.jpg" width="100%" height="300">
            <br><br><br>

            <!-- กระทู้ยอดนิยม -->
            <b><h4 style="float:left">กระทู้ยอดนิยม</h4></b>
            <b><a class="btn btn-warning text-white" href="home/allpost" style="float:right;"><u>กระทู้ทั้งหมด</u></a></b>
            <br><br>
            <table class="table table-bordered">
                <tbody>
                    <?php $__currentLoopData = $showQA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr onclick="document.location = '<?php echo e(url('post', $row->id_post)); ?>';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5><?php echo e($row->title); ?></h5>
                                <div class="float-left">
                                    <?php echo e($row->category.' '.date('H:i d/m/Y', strtotime($row->date_time_post)).' by '.$row->firstname.' '.$row->lastname); ?>

                                </div>
                                <div class="float-right">
                                    ตอบกลับ <?php echo e($row->ansCount); ?> ครั้ง
                                </div>                        
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                </tbody>
            </table>
            <br><br><br>

            <!-- บทความยอดนิยม -->
            <b><h4 style="float:left">บทความยอดนิยม</h4></b>
            <b><a class="btn btn-warning text-white" href="home/allblog" style="float:right;"><u>บทความทั้งหมด</u></a></b>
            <br><br>
            <table class="table table-bordered">
                <tbody>
                    <?php $__currentLoopData = $showBlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr onclick="document.location = '<?php echo e(url('post', $row->id_post)); ?>';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5><?php echo e($row->title); ?></h5>
                                <div class="float-left">
                                    <?php echo e($row->category.' '.date('H:i d/m/Y', strtotime($row->date_time_post)).' by '.$row->firstname.' '.$row->lastname); ?>

                                </div>
                                <div class="float-right">
                                    ถูกใจ <?php echo e($row->score); ?>

                                </div>                        
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                </tbody>
            </table>
            <br><br><br>
            
            <!-- บุคคลยอดนิยม -->
            <b><h4>บุคคลยอดนิยม</h4></b><br>
            <center>
            <div class="row">
                <?php $__currentLoopData = $popularPerson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm">
                        <div class="card" style="width: 18rem;">
                            <img src="images/<?php echo e($row->img); ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($row->firstname.' '.$row->lastname); ?></h5>
                                <p class="card-text"><?php echo e($row->bio); ?></p>
                                <a href="<?php echo e(url('profiles', $row->id_user)); ?>" class="btn btn-info">โปรไฟล์</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
            </div>
            </center>
            <br><br><br>

            <!-- หมวดหมู่ที่ถูกตั้งคำถามมากที่สุด -->
            <br><br><b><h4>หมวดหมู่ที่ถูกตั้งคำถามมากที่สุด</h4></b><br>
            <table class="table table-striped" style="text-align:center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">อันดับ</th>
                        <th scope="col">หมวดหมู่</th>
                        <th scope="col">จำนวนคำถาม</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1
                    ?>
                    <?php $__currentLoopData = $popularCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($i++); ?></th>
                            <td><?php echo e($row->category); ?></td>
                            <td><?php echo e($row->count); ?> คำถาม</td>
                            <td><a class="btn btn-success" href="<?php echo e(strtolower($row->category)); ?>">เข้าชม</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </body>
</html><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/Home.blade.php ENDPATH**/ ?>