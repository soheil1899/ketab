<ul class="sidebar-nav mb-5">
    <li class="sidebar-brand">
        <a href="#"> پنل مدیریت <strong style="color: #7ad785">SO</strong><strong style="color: #96c1ff">MO</strong>
        </a>
    </li>


    <li class="sidebar-dropdown">
        <a href="<?php echo e(route('admin')); ?>">
            <i class="fa fa-tachometer-alt ml-1"></i>
            <span>داشبورد</span>
        </a>
    </li>


        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('user.list')); ?>">
                <i class="fas fa-user-shield ml-1"></i>
                <span>کاربران</span>
            </a>
        </li>

        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('category.list')); ?>">
                <i class="fas fa-sitemap ml-1"></i>
                <span>مدیریت دسته ها</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('nasher')); ?>">
                <i class="far fa-newspaper ml-1"></i>
                <span>ناشران</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('writer.list')); ?>">
                <i class="fas fa-feather-alt ml-1"></i>
                <span>نویسندگان</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('translate.list')); ?>">
               <i class="fas fa-globe-americas ml-1"></i>
                <span>مترجمان</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('book.list')); ?>">
                <i class="fas fa-book ml-1"></i>
                <span>مدیریت کتب</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('slider')); ?>">
                <i class="far fa-image ml-1"></i>
                <span>اسلایدر سایت</span>
            </a>
        </li>
        <li class="sidebar-dropdown">
            <a href="<?php echo e(route('setting')); ?>">
                <i class="fas fa-tools ml-1"></i>
                <span>تنظیمات سایت</span>
            </a>
        </li>


</ul>


<script>
    // $('.sidebar-nav li').click(function () {
    //     if (this.getAttribute("data-id") != null){
    //
    //     }
    // });
</script>
<?php /**PATH F:\web\3-98\ketab\resources\views/layouts/admin/aside.blade.php ENDPATH**/ ?>