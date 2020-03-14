
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/images/pinlogo.png')}}">
    <title>@yield('title') | OneApps</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jqvmap/jqvmap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css"/>
    @yield('external_css')

  </head>

<body>
    <div class="be-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <!-- Top bar -->
          @include('layouts.includes.header')
        </nav>
        <div class="be-left-sidebar">
            <!-- Left sidebar -->
            @include('layouts.includes.sidebar')
        </div>
        <div class="be-content">
            <!-- Main Content -->
            <div class="main-content container-fluid">
                @yield('content')

            </div>
        </div>
        <nav class="be-right-sidebar">
            <!-- Right sidebar -->
        </nav>
    </div>
    <script src="{{ asset('assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/main.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    @yield('external_js')
    <script type="text/javascript">
        $(document).ready(function () {
            let url = window.location;
            // for sidebar menu but not for treeview submenu
            $('ul.sidebar-elements a').filter(function() {
                return this.href == url;
            }).parent().siblings().removeClass('active').end().addClass('active');
            // for treeview which is like a submenu
            $('ul.sub-menu a').filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar-elements > .sub-menu").siblings().removeClass('active').end().addClass('active');
            //initialize the javascript
            App.init();
            // App.formElements();
        });

    </script>
</body>

</html>
