<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <section class="ftco-section fixed-top">
        <div class="wrap admin-wrap">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col">
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
        <nav class="navbar  navbar-expand-lg  navbar-dark  bg-dark ftco-navbar-light ">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">Papermag <span>Blogs</span></a>

                <div class="d-flex ms-auto order-0 order-lg-2">
                    <div class="d-none d-lg-flex" id="search_form">
                        <form action="{{ route('index') }}" class="searchform">
                            <div class="form-group d-flex" style="width: 100%;position: relative">
                                <input type="text" class="form-control pl-3" id="search_bar" placeholder="Search"
                                    autocomplete="off">

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
                                <li><a class="dropdown-item" href="{{route('profile')}}">Manage Profile</a></li>
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




                {{-- <button class="navbar-toggler ms-2 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span>
				</button> --}}
                <button class="navbar-toggler ms-2 p-1" data-bs-toggle="offcanvas" data-bs-target="#ftco-nav"
                    aria-controls="ftco-nav">
                    <i class="fa-solid fa-bars"></i>`
                </button>


                <div class="offcanvas navbar-collapse  offcanvas-lg offcanvas-end h-100" tabindex="-1"
                    aria-labelledby="offcanvasLabel" id="ftco-nav" style="width:50vw">
                    <div class="offcanvas-body" style="width:100%; display:flex; justify-content:center; ">
                        <ul class="navbar-nav nav-pills" style="width:100%;">
                            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}"><a
                                    href="{{ route('index') }}" class="nav-link p-1">Home</a></li>
                            {{-- <li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Dropdown link
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<li><a class="dropdown-item" href="#">Action</a></li>
									<li><a class="dropdown-item" href="#">Another action</a></li>
									<li><a class="dropdown-item" href="#">Something else here</a></li>
									</ul>
								</li> --}}
                            <li class="nav-item {{ request()->routeIs('blogs') ? 'active' : '' }}"><a
                                    href="{{ route('blogs') }}"
                                    class="nav-link d-flex justify-content-center p-1">Blogs</a></li>
                            <li class="nav-item {{ request()->routeIs('trend') ? 'active' : '' }}"><a
                                    href="{{ route('trend') }}"
                                    class="nav-link d-flex justify-content-center p-1">Trending</a></li>
                            <li class="nav-item {{ request()->routeIs('for_you') ? 'active' : '' }}"><a
                                    href="{{ route('for_you') }}"
                                    class="nav-link d-flex justify-content-center p-1">For you</a></li>
                        </ul>
                    </div>
                </div>




            </div>

        </nav>



    </section>


    <script>
        jQuery(document).ready(function($) {
            var delayTimer;
            $('#search_bar').on('input', function() {

                var query = $(this).val().toLowerCase();
                if (query.length >= 3) {
                    clearTimeout(delayTimer);
                    delayTimer = setTimeout(function() {
                        var resultArea = $('#searchResults').find('.dropdown-menu');
                        resultArea.empty();
                        $.ajax({
                            url: "{{ route('blog.search') }}",
                            type: "POST",
                            data: {
                                query,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {

                                var blogs = data.blogs.data;
                                blogs.forEach(function(blog) {
                                    var resultHtml =
                                        '<div class="results d-flex ps-4 ps-sm-3 my-2 my-sm-3" ><div class="flex-shrink-1"><div class="result-meta d-flex"><h5 class="me-2">' +
                                        blog.title +
                                        '</h5></div><div class="result-body text-muted"><span class="mx-1">&bullet;</span>' +
                                        blog.name + '</div></div></div>';
                                    resultArea.append(resultHtml);
                                    $('.results').on('click', function(event) {
                                        var url =
                                            "{{ route('blog.show-content', ['id' => ':blogId']) }}"
                                            .replace(':blogId', blog
                                                .blog_id);
                                        resultArea.removeClass(
                                            'd-block').addClass(
                                            'd-none');
                                        window.open(url, '_blank');

                                    });
                                });



                                if (blogs.length > 0) {
                                    resultArea.removeClass('d-none').addClass('d-block')
                                } else {
                                    resultArea.removeClass('d-block').addClass(
                                    'd-none');
                                }

                            },
                            error: function(xhr, status, error) {
                                console.log('Error:', xhr.responseText);
                            }


                        });

                    }, 500);
                } else {
                    $('#searchResults').find('.dropdown-menu').removeClass('d-block').addClass('d-none');
                }

            });

            $('#search_bar').on('keyup', function(event) {
                if (event.key === 'Escape' || event.keyCode === 27) {
                    var resultArea = $('#searchResults').find('.dropdown-menu');
                    resultArea.removeClass('d-block').addClass('d-none');
                }
            });

            $('#search_bar').on('focusout', function() {
                var resultArea = $('#searchResults').find('.dropdown-menu');
                resultArea.removeClass('d-block').addClass('d-none');
            });

        });
    </script>





</body>

</html>
