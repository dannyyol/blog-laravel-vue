<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 4 Blog Template For Developers</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="/assets/css/theme-1.css">
    <link id="theme-style" rel="stylesheet" href="/assets/css/styles.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"> --}}

    <style src=""></style>
</head>

<body>
    <div id="app">
        <header class="header text-center">
            <h1 class="blog-name pt-lg-4 mb-0"><a href="">Ayo's Blog</a></h1>

            <nav class="navbar navbar-expand-lg navbar-dark" >

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navigation" class="collapse navbar-collapse flex-column" >
                    <div class="profile-section pt-3 pt-lg-0">
                        <img class="profile-image mb-3 rounded-circle mx-auto" src="/assets/images/profile.png" alt="image" >
                        @guest
                        @else
                        <div class="bio mb-3">Hi, my name is {{ Auth::user()->name }}.<br><a href="about.html">Find out more about me</a></div><!--//bio-->
                        @endguest
               <!--//social-list-->
                        <hr>
                    </div><!--//profile-section-->

                    <ul class="navbar-nav flex-column text-left">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/"><i class="fas fa-home fa-fw mr-2"></i>Blog Home <span class="sr-only">(current)</span></router-link>
                        </li>

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
                            <li class="nav-item">
                                

                                {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-power-off" aria-hidden="true"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                {{-- </div> --}}
                            </li>
                        @endguest

                        @if (auth()->user())
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ url('create')}}"><i class="fas fa-user fa-fw mr-2"></i>Create Post</a> --}}
                                <router-link class="nav-link" to="/create"><i class="fas fa-user fa-fw mr-2"></i>Create Post</router-link>

                            </li>

                           

                        @endif
                    </ul>

                    <div class="my-2 my-md-3">
                        <a class="btn btn-primary" href="" target="_blank">Get in Touch</a>
                    </div>
                </div>
            </nav>
        </header>
        {{-- <router-view></router-view> --}}
        @yield('content')

        <footer class="footer text-center py-2 theme-bg-dark">

            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
                <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

        </footer>

    </div>
</div><!--//main-wrapper-->




<!-- *****CONFIGURE STYLE (REMOVE ON YOUR PRODUCTION SITE)****** -->
<div id="config-panel" class="config-panel d-none d-lg-block">
    <div class="panel-inner">
        <a id="config-trigger" class="config-trigger config-panel-hide text-center" href="#"><i class="fas fa-cog fa-spin mx-auto" data-fa-transform="down-6" ></i></a>
        <h5 class="panel-title">Choose Colour</h5>
        <ul id="color-options" class="list-inline mb-0">
            <li class="theme-1 active list-inline-item"><a data-style="assets/css/theme-1.css" href="#"></a></li>
            <li class="theme-2  list-inline-item"><a data-style="assets/css/theme-2.css" href="#"></a></li>
            <li class="theme-3  list-inline-item"><a data-style="assets/css/theme-3.css" href="#"></a></li>
            <li class="theme-4  list-inline-item"><a data-style="assets/css/theme-4.css" href="#"></a></li>
            <li class="theme-5  list-inline-item"><a data-style="assets/css/theme-5.css" href="#"></a></li>
            <li class="theme-6  list-inline-item"><a data-style="assets/css/theme-6.css" href="#"></a></li>
            <li class="theme-7  list-inline-item"><a data-style="assets/css/theme-7.css" href="#"></a></li>
            <li class="theme-8  list-inline-item"><a data-style="assets/css/theme-8.css" href="#"></a></li>
        </ul>
        <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
    </div><!--//panel-inner-->
</div><!--//configure-panel-->


<style>
    .router-link-exact-active {
        background: #4b4545;
        color: #fff !important;
    }
</style>
<!-- Javascript -->
<script src="/assets/plugins/jquery-3.3.1.min.js"></script>
<script src="/assets/plugins/popper.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
<script src="/assets/js/demo/style-switcher.js"></script>
<script src="/js/app.js" charset="utf-8"></script>


</body>
</html>
