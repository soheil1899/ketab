<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo e($setting['header_description']); ?>">
    <meta name="keywords" content="<?php echo e($setting['keywords']); ?>">


    <link rel="stylesheet" href="/css/client.css">


    <title>شهر کتاب آنلاین</title>

</head>
<body class="clientbody" dir="rtl">
<div id="client">
    <header>
        <?php echo $__env->make('layouts.client.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>

    <div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer>
        <?php echo $__env->make('layouts.client.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </footer>
</div>
</body>

<script src="/js/client.js"></script>


</html>
<script>
    import Menu from "../../../js/components/client/Menu";
    export default {
        components: {Menu}
    }
</script>
<?php /**PATH F:\web\3-98\ketab\resources\views/layouts/client/master.blade.php ENDPATH**/ ?>