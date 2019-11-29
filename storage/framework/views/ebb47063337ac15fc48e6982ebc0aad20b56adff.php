<div class="row mx-0 bg-dark headerborder py-2">
    <div class="col-12 col-lg-3 px-1 text-right">
        <img src="/media/cite/logo/logo.png" class="px-lg-5 px-1">
    </div>
    <div class="col-12 col-lg-5 px-lg-1 mt-auto">
        <search_compo></search_compo>
    </div>
    <div class="col-12 col-lg-4 pl-lg-4 mt-auto">
        <?php if(Route::has('login')): ?>
            <div class="links">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->id == 1): ?>
                        <label class="logintxt px-1">
                            <?php echo e(auth()->user()->name); ?>

عزیز خوش آمدید.
                        </label>
                        <label class="px-2 logintxt">|</label>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="logintxt px-1">پنل مدیریت</a>
                    <?php else: ?>
                        <label class="logintxt px-1">
                            <?php echo e(auth()->user()->name); ?>

                            عزیز خوش آمدید.
                        </label>
                    <?php endif; ?>
                        <label class="px-2 logintxt">|</label>
                    <a class="logintxt px-1" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        خروج
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="logintxt px-1">ورود</a>
<label class="px-2 logintxt">|</label>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="logintxt px-1">ثبت نام</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php /**PATH F:\web\3-98\ketab\resources\views/layouts/client/header.blade.php ENDPATH**/ ?>