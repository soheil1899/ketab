<?php $__env->startSection('content'); ?>


    <menu-compo></menu-compo>


    <div class="container py-3 px-0">
        <div class="row mx-0">
            <div class="col-lg-2 d-none d-lg-block pr-0">
                <leftside-compo :title="'download'"></leftside-compo>
            </div>
            <div class="col-12 col-lg-8">
                <contact-compo :setting="<?php echo e($setting); ?>"></contact-compo>
            </div>
            <div class="col-lg-2 d-none d-lg-block pl-0">
                <leftside-compo :title="'likes'"></leftside-compo>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\web\3-98\ketab\resources\views/contact.blade.php ENDPATH**/ ?>