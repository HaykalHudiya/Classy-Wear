<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="Assets\Icon\logo-CW.png" type="image/icon type">
    <title>Dashboard</title>
    <link rel="stylesheet" href="B5/css/bootstrap.min.css">
    <link rel="stylesheet" href="B5/Icon/font/bootstrap-icons.css">
    <style>
        .custom-navbar {
            border-top: 4px solid #B67685;
            border-bottom: 4px solid #B67685;
            padding: 0;
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

        .carousel-inner img {
            width: 100%;
            height: auto;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 15;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .carousel-indicators li {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            margin-right: 5px;
            cursor: pointer;
        }

        .carousel-indicators .active {
            background-color: #B67685;
        }

        @media (max-width: 768px) {
            .nav-item {
                width: 100%;
                text-align: center;
            }

            .nav-link {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <div class="d-flex flex-column text-center" style="background-color: #F3D7CA">
            <img class="d-block mx-auto mb-4" src="Assets\Icon\logo-CW.png" alt="" width="100"
                height="100">
            <nav class="navbar custom-navbar" style="background-color: #FFF8E3 ">
                <div class="container-fluid d-flex justify-content-center">
                    <ul class="nav flex-fill justify-content-center">
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/newarrival">New Arrival</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/best-seller">Best Seller</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/shirt">Shirt</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/outerwear">Outerwear</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="tshirt">T-Shirt</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/pants">Pants</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="d-flex flex-column" style="background-color: #F5EEE6">
            <div class="search-container d-flex flex-row-reverse p-3">
                <input class="form-control" type="search" placeholder="What can I help you to find?"
                    aria-label="Search">
                <i class="bi bi-search search-icon"></i>
            </div>
            <div class="container-fluid" style="background-color: #F5EEE6">
                <div class="d-flex align-items-stretch justify-content-center">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Assets/Dashboard/Group_15.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Assets/Dashboard/Group_15.1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Assets/Dashboard/Group_15.2.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-3" style="background-color: #F3D7CA">
        <ul class="nav justify-content-center pb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary mx-1"><i
                        class="bi bi-facebook" style="font-size: 35px"></i></a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary mx-1"><i
                        class="bi bi-instagram" style="font-size: 35px"></i></a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary mx-1"><i
                        class="bi bi-tiktok" style="font-size: 35px"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary mx-1"><i
                        class="bi bi-whatsapp" style="font-size: 35px"></i></a></li>
        </ul>
        <ul class="nav justify-content-center border-bottom border-white pb-3 mb-3">
            <p style="font-size: 45px">Wear Confidence Wear Us</p>
        </ul>
        <img class="d-block mx-auto" src="{{ asset('Assets\Icon\logo-CW.png') }}" alt="" width="150"
            height="150">
        <p class="text-center text-body-secondary">© 2024 Classy Wear, Inc</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="B5/js/bootstrap.bundle.min.js"></script>
    <script>
        const myCarouselElement = document.querySelector('#carouselExampleIndicators');
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 3000,
            pause: 'hover'
        });
    </script>
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
