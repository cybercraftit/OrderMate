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
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    @lang('ordermate::main.You are not allowed to access this page')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ordermate = {
        components: {
        },
        data: {},
        methods: {}
    }
</script>
<script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate.js') }}"></script>
</body>
</html>