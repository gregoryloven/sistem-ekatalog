<div class="fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-expand-lg navbar-freya navbar-light"> <a class="navbar-brand" href="../index.html">
            <div class="freya-logo">Freya</div>
        </a><button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbarCollapse" aria-controls="primaryNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="hamburger hamburger--emphatic"><span class="hamburger-box"><span class="hamburger-inner"></span></span></span></button>
        <div class="collapse navbar-collapse" id="primaryNavbarCollapse">
            <ul class="navbar-nav py-3 py-lg-0 mt-1 mb-2 my-lg-0 ms-lg-n1">
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Home</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../index.html">Slider Header</a></li>
                <li><a class="dropdown-item" href="../homes/header-slider-classic.html">Slider Classic</a></li>
                <li><a class="dropdown-item" href="../homes/header-static.html">Static Header</a></li>
                <li><a class="dropdown-item" href="../homes/header-static-classic.html">Static Classic</a></li>
                <li><a class="dropdown-item" href="../homes/header-youtube-video.html">Youtube Background</a></li>
                <li><a class="dropdown-item" href="../homes/header-youtube-video-classic.html">Youtube Classic</a></li>
                <li><a class="dropdown-item" href="../homes/header-selfhosted-video.html">Self-hosted Video</a></li>
                <li><a class="dropdown-item" href="../homes/header-selfhosted-video-classic.html">Self-hosted Classic</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="about.html">About</a></li>
                <li><a class="dropdown-item" href="recognition.html">Recognition</a></li>
                <li><a class="dropdown-item" href="blank.html">Blank Page</a></li>
                <li><a class="dropdown-item" href="404.html">404 Page</a></li>
                <li class="dropend"><a class="dropdown-item dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                    <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="login.html">Login</a></li>
                    <li> <a class="dropdown-item" href="registration.html">Registration</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Projects</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../projects/projects.html">Projects Gallery</a></li>
                <li><a class="dropdown-item" href="../projects/project.html">Single Project</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../blog/blog-list.html">Blog List</a></li>
                <li><a class="dropdown-item" href="../blog/blog.html">Single Blog</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contact</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../contact/contact1.html">Contact 1</a></li>
                <li><a class="dropdown-item" href="../contact/contact2.html">Contact 2</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Elements</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../elements/buttons.html">Buttons</a></li>
                <li><a class="dropdown-item" href="../elements/colors.html">Colors</a></li>
                <li><a class="dropdown-item" href="../elements/googlemap.html">Google Map</a></li>
                <li><a class="dropdown-item" href="../elements/grid.html">Grid</a></li>
                <li><a class="dropdown-item" href="../elements/icons.html">Icons</a></li>
                <li><a class="dropdown-item" href="../elements/layouthelpers.html">Layout Helpers</a></li>
                <li><a class="dropdown-item" href="../elements/modal-video.html">Modal Video</a></li>
                <li><a class="dropdown-item" href="../elements/swiper.html">Swiper</a></li>
                <li><a class="dropdown-item" href="../elements/typography.html">Typography</a></li>
                </ul>
            </li>
            </ul>
            <ul class="navbar-nav ms-lg-auto flex-row justify-content-center py-3 py-lg-0 me-n2">
            <li><a class="nav-link px-2" href="#"><span class="fab fa-facebook-f" data-fa-transform="shrink-2"></span></a></li>
            <li><a class="nav-link px-2" href="#"><span class="fab fa-twitter" data-fa-transform="shrink-2"></span></a></li>
            <li><a class="nav-link px-2" href="#"><span class="fab fa-instagram" data-fa-transform="shrink-2"></span></a></li>
            <li><a class="nav-link px-2" href="#"><span class="fab fa-dribbble" data-fa-transform="shrink-2"></span></a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
        </nav>
    </div>
</div>