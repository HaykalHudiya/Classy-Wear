<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="Assets\Icon\logo-CW.png" type="image/icon type">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('B5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('B5/Icon/font/bootstrap-icons.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montaga&display=swap" rel="stylesheet">
    <style>
        .custom-navbar {
            border-top: 4px solid #B67685;
            border-bottom: 4px solid #B67685;
            padding: 0;
        }

        .montaga-regular {
            font-family: "Montaga", serif;
            font-weight: 400;
            font-style: normal;
        }

        .nav-link {
            color: black;
        }

        .nav-link:hover {
            background-color: #B67685;
            color: white;
        }

        .nav-link.active {
            background-color: #B67685;
            color: white;
        }

        .search-container {
            position: relative;
        }

        .search-container input[type="search"] {
            padding-right: 2.5rem;
            width: 100%;
            max-width: 300px;
        }

        .search-container .search-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .product-card {
            border: none;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .product-img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.1);
        }

        .search-icons {
            position: absolute;
            bottom: 20px;
            right: 10px;
            background-color: #F5EEE6;
            border: none;
            padding: 20px;
            color: black;
        }

        .modal-content {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .btn-outline-secondary.disabled {
            pointer-events: none;
            opacity: 0.65;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .product-price {
            color: black;
            font-size: 1.25rem;
        }

        .modal-backdrop.show {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .btn.rounded-circle {
            width: 2.5rem;
            height: 2.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
        }

        .cards {
            margin-bottom: 20px;
        }

        .recommended-products img {
            width: 100%;
            height: auto;
        }

        #quantity {
            pointer-events: none;
        }

        .selected {
            border: 2px solid #000;
            background-color: #ddd;
        }

        .cart-icon {
            position: relative;
        }

        .cart-icon .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 8px;
        }

        <style>.product-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-card {
            max-width: 100%;
            margin: auto;
        }

        .product-img {
            width: 100%;
            height: auto;
        }

        .product-title,
        .product-price {
            width: 100%;
            text-align: center;
        }

        .modal-body img {
            width: 100%;
            height: auto;
        }

        .product-wrapper.single-product {
            width: 1000px;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .product-wrapper.double-product {
            width: 1000px;
            max-width: 1000px;
            margin-left: 1%;
            text-align: center;
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-item {
                width: 100%;
                text-align: center;
            }

            .navbar-nav .nav-link {
                padding: 10px;
            }

            .search-container input[type="search"] {
                width: 100%;
            }

            .product-card {
                width: 100%;
                height: auto;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .card-text {
                font-size: 0.9rem;
            }

            .card {
                margin-bottom: 1rem;
            }

            .product-wrapper.single-product {
                width: 100%;
                max-width: 300px;
            }

            .product-wrapper.double-product {
                width: 100%;
                max-width: 300px;
            }

            @media (max-width: 576px) {
                .card-text {
                    font-size: 0.8rem;
                }

                .product-card {
                    width: 100%;
                    height: auto;
                }

                .table-responsive {
                    overflow-x: auto;
                }

                .card {
                    margin-bottom: 1rem;
                }
            }
        }
    </style>
</head>

<body class="montaga-regular">
    <div class="container-fluid px-0">
        @include('frames.header')
        <div class="d-flex flex-column" style="background-color: #F5EEE6">
            @yield('search')
            <div class="container-fluid" style="background-color: #F5EEE6">
                <div class="d-flex align-items-stretch justify-content-center">
                    <div class="main-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('frames.product-modal')
    </div>
    @include('frames.footer')
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('B5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = window.location.href;
            const menuItems = document.querySelectorAll('.nav-link');

            menuItems.forEach(item => {
                if (item.href === currentLocation) {
                    item.classList.add('active');
                }
            });
        });
    </script>

</body>

</html>
