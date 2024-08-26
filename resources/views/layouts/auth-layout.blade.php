<!doctype html>
<html lang="en">
<head>
    <title>Hireo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors/blue.css') }}">

</head>
<body>

    <div id="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 offset-xl-3">
                    
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

</body>
</html>