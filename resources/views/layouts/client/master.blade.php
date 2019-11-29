<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$setting['header_description']}}">
    <meta name="keywords" content="{{$setting['keywords']}}">


    <link rel="stylesheet" href="/css/client.css">


    <title>شهر کتاب آنلاین</title>

</head>
<body class="clientbody" dir="rtl">
<div id="client">
    <header>
        @include('layouts.client.header')
    </header>

    <div>
        @yield('content')
    </div>

    <footer>
        @include('layouts.client.footer')
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
