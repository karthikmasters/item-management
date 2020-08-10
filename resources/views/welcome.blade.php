<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Items Management</title>
</head>

<body>
<div id="app">
    <div class="container">
        <items-management></items-management>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
