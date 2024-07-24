<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'DOME STUDIO')</title> <!-- Default title if none is specified -->

    <!-- Custom fonts for this template-->
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <!-- Chart.js Plugin for Zoom -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>

    <!-- Custom styles for charts -->
    <link href="{{ asset('import/assets/css/chart-js.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@latest/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>

    <style>
        .bg-grey {
            background-color: #b62d3a;
        }

        /* rgb(54 54 105) */

        .item-divider {
            margin: 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .sidebar .nav-item.active a,
        .sidebar .nav-item a:active,
        .sidebar .nav-item a:focus,
        .sidebar .nav-item a:hover {
            background-color: white !important;
            color: black
        }

        .sidebar .nav-item a {
            color: white;
            /* Default color */
            transition: color 0.3s ease;
            /* Smooth transition for color change */
        }

        .card {
            flex: 1;
            margin: 0 5px;
            overflow: hidden;
        }

        .font-custom {
            font-size: 12px;
        }

        .value-unit-container {
            display: flex;
            align-items: center;
            width: 100px;
            justify-content: flex-end;
        }

        .value-box {
            width: 100px;
            background-color: #2b2b2b;
            color: white;
            border-radius: 5px;
            text-align: center;
            padding: 2px 2px;
            font-weight: bold;
        }

        .unit-text {
            width: 40px;
            margin-left: 5px;
            color: red;
            text-align: left;
        }
    </style>
</head>

<body id="page-top">
    @yield('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarItems = document.querySelectorAll('#accordionSidebar .nav-item');

            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    sidebarItems.forEach(function(i) {
                        i.classList.remove('active');
                    });

                    // Add active class to clicked item
                    this.classList.add('active');
                });

                // Check if the current page matches the link's href
                if (item.querySelector('a').getAttribute('href') === window.location.pathname) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>