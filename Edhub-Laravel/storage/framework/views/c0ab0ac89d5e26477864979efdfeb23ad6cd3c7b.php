<?php $__env->startSection('title','search result'); ?>
<?php $__env->startSection('content'); ?>
<br />
<div class="container">
    <?php
    $cntName=0;
    $cntPost=0;
    $cntArc=0;
    foreach($select_name as $cntn){
        $cntName++;
    }  
    foreach($select_title as $cntt){
        if($cntt->type == 'กระทู้'){
            $cntPost++;
        }else{
            $cntArc++;
        }
    }  
    ?>
    <br>
    <img src="images/result.jpg" width="100%" height="300">
    <br>
    <b><h2 style="float:left"><font color="#C0C0C0">ผลลัพธ์ทั้งหมด <?php echo $cntName+$cntPost+$cntArc;?></font></h2></b>
    <br>
    <div class="w3-bar w3-light">
    <?php if($cntName != 0): ?>
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'People');">คน <?php echo $cntName;?></button>
    <?php endif; ?>
    <?php if($cntPost != 0): ?>
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'Post');">กระทู้ <?php echo $cntPost;?></button>
    <?php endif; ?>
    <?php if($cntArc != 0): ?>
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'Article');">บทความ <?php echo $cntArc;?></button>
    <?php endif; ?>
    </div>
    <?php if($cntName != 0): ?>
    <div id="People" class="row myLink">
        <?php $__currentLoopData = $select_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table class="table table-bordered">
                <tbody>
                    <tr onclick="document.location = '<?php echo e(url('profiles', $item->id_user)); ?>';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                        <td scope="row">

                            <h5><?php echo e($item->firstname); ?> <?php echo e($item->lastname); ?></h5>
                            <div class="float-left">
                                <?php echo e($item->jobs); ?>

                            </div>
                            <div class="float-right">
                               <img srt="../images/<?php echo e($item->img); ?>" >
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if($cntPost != 0): ?>
    <div id="Post" class="row myLink">
        <?php $__currentLoopData = $select_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($title->type == 'กระทู้'): ?>
            
            
                <table class="table table-bordered">
                    <tbody>
                        <tr onclick="document.location = '<?php echo e(url('post', $title->id_post)); ?>';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5><?php echo e($title->title); ?></h5>
                                <div class="float-left">
                                    <?php echo e($title->category.' '.date('H:i d/m/Y', strtotime($title->date_time_post))); ?>

                                </div>
                                <div class="float-right">
                                    ตอบกลับ <?php echo e($title->ansCount); ?> ครั้ง
                                </div>
                            </td>
                        </tr>
                        </tbody>
                </table>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
        </div>
        <?php endif; ?>
            
    <?php if($cntArc != 0): ?>
        <div id="Article" class="row myLink">
        <?php $__currentLoopData = $select_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($title->type == 'บทความ'): ?>
            
            
                <table class="table table-bordered">
                    <tbody>
                    <tr onclick="document.location = '<?php echo e(url('post', $title->id_post)); ?>';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5><?php echo e($title->title); ?></h5>
                                <div class="float-left">
                                    <?php echo e($title->category.' '.date('H:i d/m/Y', strtotime($title->date_time_post))); ?>

                                </div>
                                <div class="float-right">
                                    ถูกใจ <?php echo e($title->score); ?>

                                </div>
                            </td>
                        </tr>
                        </td>
                    </tr>
                </tbody>
                </table>
                
            
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if($cntArc == 0 && $cntName == 0 && $cntPost == 0): ?>
       <h1><center>No result </center></h1>
    <?php endif; ?>
</div>
<!-- End of container -->
<script type="text/javascript">        // Tabs
    function openLink(evt, linkName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("myLink");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(linkName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }
    // Click on the first tablink on load
    document.getElementsByClassName("tablink")[0].click();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/Edhub-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/searchResult.blade.php ENDPATH**/ ?>