<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title> <!-- Default title if none is specified -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
        .bg-grey {
            background-color: #b62d3a;
        }

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

<body>
    @yield('content')
</body>

</html>