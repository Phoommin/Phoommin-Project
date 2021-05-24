<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <title> Post </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <style>
        .bg-bluecolorheader {
            background: #7EC9C5 no-repeat padding-box;
        }
    </style>
</head>

 <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-warning"> -->
        <a class="navbar-brand" href="#">
                <img src="https://img.icons8.com/material/24/000000/home--v5.png" width="30" height="30" alt="">
                </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Contact<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Post
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Math</a>
                <a class="dropdown-item" href="#">Science</a>
                <a class="dropdown-item" href="#">Social</a>
                <a class="dropdown-item" href="#">Language</a>
                <a class="dropdown-item" href="#">Arts</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"></a>
                </div>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <input type="image" src="https://img.icons8.com/material-rounded/24/000000/search.png" alt="Submit">
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
<?php $__currentLoopData = $show_ans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<br />
<div class="container">
  <!--Form Input Your Answers-->
  <div class="row">
    <h4>Answers</h4> 
  </div>
  <div class="row">
    <form class="form-inline border shadow-sm p-3 mb-5 bg-white rounded col-12" method="post" action="<?php echo e(url('insert_ans')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id_ans" value="<?php echo e($row->id_ans); ?>" />
        <textarea class="form-control col-11" name="ans" rows="3" style="border: none; resize: none;"> 
            <?php echo e($row->message); ?>

        </textarea>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <input type="image" name="submit" src="<?php echo e(asset('images/icon_message.png')); ?>" alt="Submit" style="width: 45px;" />
    </form>
  </div>
  <!--/Form Input Your Answers-->
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script> 
</body>
</html><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/edit_ans.blade.php ENDPATH**/ ?>