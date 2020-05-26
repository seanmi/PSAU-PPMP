<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PPMP</title>
    @include('shared.layouts.header')
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        @include('vp.layouts.nav')
        <div id="page-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    @include('shared.layouts.footer')
    @yield('footer-scripts')
</body>

</html>
