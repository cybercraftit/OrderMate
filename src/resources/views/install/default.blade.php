<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="ordermate">
    <div class="container-fluid">
        @yield('body')
    </div>
</div>
<script>
    var ordermate = {
        components: {
        },
        data: {
            test: 'This is test',
        },
        methods: {
        }
    }
</script>
@yield('coremate_script_top')
<script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate.js') }}"></script>
@yield('script')
</body>
</html>