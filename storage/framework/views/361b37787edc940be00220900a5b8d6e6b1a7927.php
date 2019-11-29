<?php $__env->startSection('content'); ?>


    <menu-compo></menu-compo>


    <div class="container py-3 px-0">
        <div class="row mx-0">
            <?php
                if (auth()->check()){
                    $myauth = '1';
                }else{
                    $myauth = '0';
                }
            ?>
            <div class="col-lg-2 d-none d-lg-block pr-0">
                <leftside-compo :title="'download'" :auth="<?php echo e($myauth); ?>"></leftside-compo>
            </div>
            <div class="col-12 col-lg-8">
                <div class="row mx-0 mt-4">
                    <div class="col-12">
                        <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                            <strong>
                                نتایج جستجو برای :
                                <?php echo e($searchtext); ?>

                            </strong>
                        </h3>
                    </div>
                    <div class="col-12 mt-4">
                        <show-search :book="<?php echo e($book); ?>" :nasher="<?php echo e($nasher); ?>" :writer="<?php echo e($writer); ?>" :translator="<?php echo e($translator); ?>" :auth="<?php echo e($myauth); ?>"></show-search>
                    </div>
                </div>

            </div>
            <div class="col-lg-2 d-none d-lg-block pl-0">
                <leftside-compo :title="'likes'" :auth="<?php echo e($myauth); ?>"></leftside-compo>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\3-98\ketab\resources\views/searchshow.blade.php ENDPATH**/ ?>