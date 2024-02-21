<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html,
        body {
            height: 100%;
        }
    </style>

</head>

<body>
    <div class="container-fluid p-0 d-flex h-100">
        <div id="bdSidebar"
            class="d-flex flex-column flex-shrink-0 p-3 bdSidebar text-white offcanvas-md offcanvas-start position-fixed top-0 h-100">
            <a href="{{ route('admin.index') }}" class="navbar-brand">
                <h5> PAPERMAG <span>BLOGS</span></h5>
            </a>
            <hr>
            <ul class="mynav nav nav-pills flex-column mt-3 mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}"
                        class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}"
                        class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.write') }}"
                        class="{{ request()->routeIs('admin.write') ? 'active' : '' }}">
                        Write Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blogs') }}"
                        class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                        Blogs
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.trend') }}"
                        class="{{ request()->routeIs('admin.blog') ? 'active' : '' }}">
                        Trending
                    </a>
                </li>


            </ul>

        </div>

        <div class="flex-fill right-container">


            <div class="wrap">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col d-flex justify-content-start align-items-center">
                            <p class="mb-0 email"> <i class="fa-sharp fa-solid fa-envelope"></i><a
                                    href="#">&nbsp;abc@gmail.com</a></p>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <div class="social-media">
                                <p class="mb-0 d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa-brands fa-facebook"><i class="sr-only">Facebook</i></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa-brands fa-twitter"><i class="sr-only">Twitter</i></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="fa-brands fa-instagram"><i class="sr-only">Instagram</i></span></a>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-md navbar-dark  bg-dark ftco-navbar-light">

                <div class="container">
                    <a class="navbar-brand d-md-none" href="{{ route('admin.index') }}">Papermag <span>Blogs</span></a>

                    <div class="d-flex ms-auto order-0 order-lg-2">
                        <div class="d-none d-lg-flex" id="search_form">
                            <form action="{{ route('index') }}" class="searchform">
                                <div class="form-group d-flex" style="width: 100%;position: reference">
                                    <input type="text" class="form-control pl-3" id="search_bar"
                                        placeholder="Search">

                                    <button type="submit" placeholder="" class="form-control search"><span
                                            class="fa fa-search"></span></button>

                                </div>
                                <div id="searchResults" class="dropdown"
                                    style="position: absolute;bottom:0;width:300px !important">
                                    <div class="dropdown-menu d-none" aria-labelledby="search_form">

                                    </div>
                                </div>
                            </form>
                        </div>



                        @if (Auth::check())
                            <div class="pro_not d-flex justify-content-center align-items-center ms-4 position-relative">
                                <a href="" class="d-flex align-items-center justify-content-center"><span
                                        class="fa-regular fa-bell"><i class="sr-only"></i></span></a>
                                <img src="{{ asset('images/profile/default.png') }}" alt="Avatar"
                                    class="btn btn-outline-primary avatar dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <ul class="dropdown-menu position-absolute" aria-labelledby="navbarDropdown"
                                    style="left:-100px;">
                                    <li><a class="dropdown-item" href="{{route('admin.profile')}}">Manage Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider mx-auto" style="width:75%">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        @endif
                    </div>

                    <a href="#" class="text-black d-md-none" data-bs-toggle="offcanvas"
                        data-bs-target="#bdSidebar">
                        <i class="fa-solid fa-bars"></i>`
                    </a>
                </div>
            </nav>

            <section>
                @yield('content')
            </section>

        </div>


    </div>


</body>

</html>
