<?php $__env->startSection('title','Science'); ?>
<?php $__env->startSection('content'); ?>
    <br>
    <img src="images/sci.jpg" width="100%" height="300">
    <br><br><br>

    <!-- กระทู้ยอดนิยม -->
    <b><h4 style="float:left">กระทู้ยอดนิยม</h4></b>
    <b><a class="btn btn-warning text-white" href="science/allpost" style="float:right;"><u>กระทู้ทั้งหมด</u></a></b>
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
    <b><a class="btn btn-warning text-white" href="science/allblog" style="float:right;"><u>บทความทั้งหมด</u></a></b>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/Edhub-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Edhub\resources\views/science.blade.php ENDPATH**/ ?>