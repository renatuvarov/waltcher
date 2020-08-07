<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Waltcher">
    @section('title')
        <title>Waltcher</title>
    @show
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header>
    <nav id="navbar" class="navbar fixed-top navbar-expand-lg">
        <a id="logo" class="navbar-brand navbar-logo-img" href="{{ route('main') }}">
            <img src="{{ asset('assets/img/logo.webp') }}" class="menu-logo-img" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="16px" enable-background="new 0 0 124 124" version="1.1" viewBox="0 0 124 124"
                 xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path
                    d="M112,6H12C5.4,6,0,11.4,0,18s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,6,112,6z"/>
                <path d="m112 50h-100c-6.6 0-12 5.4-12 12s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"/>
                <path d="m112 94h-100c-6.6 0-12 5.4-12 12s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"/></svg>
        </button>
        <div class="navbar-collapse" id="navbarSupportedContent">
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
            <label class="btn-menu" for="hmt">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
            </label>
            <ul itemscope="" itemtype="https://www.schema.org/SiteNavigationElement" id="navbar-nav"
                class="hidden-menu navbar-nav">
                <li itemprop="name" class="nav-item">
                    <a itemprop="url" class="nav-link" href="{{ route('main') }}">Home</a>
                </li>
                <li itemprop="name" class="nav-item">
                    <a itemprop="url" class="nav-link" href="{{ route('user.catalog.index') }}">Equipment</a>
                </li>
                <li itemprop="name" class="nav-item">
                    <a itemprop="url" class="nav-link" href="{{ route('user.exhibitions.news.index') }}">Exhibitions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main') . '#contacts' }}">Contacts</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

@yield('body')

<footer>
    <div class="footer container-fluid footer-background">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 col-xl-4 footer-logo">
                        <img src="{{ asset('assets/img/logo.webp') }}" class="img-fluid" alt="">
                        <p class="footer-about-text">Company Waltcher GmbH founded in 2009 in Krefeld. Main business —
                            manufacturing, import and export of equipemnt for confectionery and chocolate industry,
                            equipment and machinery for other industry areas, transfer of technologies, food, creating
                            joint or separate projects for manufacturing products in Germany with financial support of
                            government.</p>
                    </div>
                    <div class="col-md-6 col-xl-8 d-flex justify-content-end">
                        <div class="col-sm-8 col-md-8 col-lg-6 col-xl-4 footer-contacts">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="footer-tittle">Contacts</h3>
                                    <ul>
                                        <li>Hardenbergstrasse 53, 47799 Krefeld, Germany</li>
                                        <li>+49 (0) 179 - 776-65-20 (WhatsApp)</li>
                                        <li>info@waltcher.com</li>
                                        <li>+49 (0) 2151 - 416-13-09</li>
                                        <li>
                                            <div class="social-icon">
                                                <a href="https://www.instagram.com/waltchergmbh/" target="_blank">
                                                    <svg viewBox="0 0 511 511.9" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m510.949219 150.5c-1.199219-27.199219-5.597657-45.898438-11.898438-62.101562-6.5-17.199219-16.5-32.597657-29.601562-45.398438-12.800781-13-28.300781-23.101562-45.300781-29.5-16.296876-6.300781-34.898438-10.699219-62.097657-11.898438-27.402343-1.300781-36.101562-1.601562-105.601562-1.601562s-78.199219.300781-105.5 1.5c-27.199219 1.199219-45.898438 5.601562-62.097657 11.898438-17.203124 6.5-32.601562 16.5-45.402343 29.601562-13 12.800781-23.097657 28.300781-29.5 45.300781-6.300781 16.300781-10.699219 34.898438-11.898438 62.097657-1.300781 27.402343-1.601562 36.101562-1.601562 105.601562s.300781 78.199219 1.5 105.5c1.199219 27.199219 5.601562 45.898438 11.902343 62.101562 6.5 17.199219 16.597657 32.597657 29.597657 45.398438 12.800781 13 28.300781 23.101562 45.300781 29.5 16.300781 6.300781 34.898438 10.699219 62.101562 11.898438 27.296876 1.203124 36 1.5 105.5 1.5s78.199219-.296876 105.5-1.5c27.199219-1.199219 45.898438-5.597657 62.097657-11.898438 34.402343-13.300781 61.601562-40.5 74.902343-74.898438 6.296876-16.300781 10.699219-34.902343 11.898438-62.101562 1.199219-27.300781 1.5-36 1.5-105.5s-.101562-78.199219-1.300781-105.5zm-46.097657 209c-1.101562 25-5.300781 38.5-8.800781 47.5-8.601562 22.300781-26.300781 40-48.601562 48.601562-9 3.5-22.597657 7.699219-47.5 8.796876-27 1.203124-35.097657 1.5-103.398438 1.5s-76.5-.296876-103.402343-1.5c-25-1.097657-38.5-5.296876-47.5-8.796876-11.097657-4.101562-21.199219-10.601562-29.398438-19.101562-8.5-8.300781-15-18.300781-19.101562-29.398438-3.5-9-7.699219-22.601562-8.796876-47.5-1.203124-27-1.5-35.101562-1.5-103.402343s.296876-76.5 1.5-103.398438c1.097657-25 5.296876-38.5 8.796876-47.5 4.101562-11.101562 10.601562-21.199219 19.203124-29.402343 8.296876-8.5 18.296876-15 29.398438-19.097657 9-3.5 22.601562-7.699219 47.5-8.800781 27-1.199219 35.101562-1.5 103.398438-1.5 68.402343 0 76.5.300781 103.402343 1.5 25 1.101562 38.5 5.300781 47.5 8.800781 11.097657 4.097657 21.199219 10.597657 29.398438 19.097657 8.5 8.300781 15 18.300781 19.101562 29.402343 3.5 9 7.699219 22.597657 8.800781 47.5 1.199219 27 1.5 35.097657 1.5 103.398438s-.300781 76.300781-1.5 103.300781zm0 0"></path>
                                                        <path
                                                            d="m256.449219 124.5c-72.597657 0-131.5 58.898438-131.5 131.5s58.90343 131.5 131.5 131.5c72.601562 0 131.5-58.898438 131.5-131.5s-58.898438-131.5-131.5-131.5zm0 216.800781c-47.097657 0-85.300781-38.199219-85.300781-85.300781s38.203124-85.300781 85.300781-85.300781c47.101562 0 85.300781 38.199219 85.300781 85.300781s-38.199219 85.300781-85.300781 85.300781zm0 0"></path>
                                                        <path
                                                            d="m423.851562 119.300781c0 16.953125-13.746093 30.699219-30.703124 30.699219-16.953126 0-30.699219-13.746094-30.699219-30.699219 0-16.957031 13.746093-30.699219 30.699219-30.699219 16.957031 0 30.703124 13.742188 30.703124 30.699219zm0 0"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="social-icon">
                                                <a href="https://www.facebook.com/WaltcherGMBH/" target="_blank">
                                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m437 0h-362c-41.351562 0-75 33.648438-75 75v362c0 41.351562 33.648438 75 75 75h151v-181h-60v-90h60v-61c0-49.628906 40.371094-90 90-90h91v90h-91v61h91l-15 90h-76v181h121c41.351562 0 75-33.648438 75-75v-362c0-41.351562-33.648438-75-75-75zm0 0"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 footer-links">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="footer-tittle">Links</h3>
                                    <ul>
                                        <li><a href="{{ route('main') }}">Home</a></li>
                                        <li><a href="{{ route('user.catalog.index') }}">Equipment</a></li>
                                        <li><a href="{{ route('user.exhibitions.news.index') }}">Exhibitions</a></li>
                                        <li><a href="/#contacts">Contacts</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lightgallery.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        jQuery(document).ready(function ($) {
            $("#lightgalery").lightGallery({});
        });
    </script>
    <script>
        new WOW().init();
    </script>
    @stack('js')
</footer>
</body>
</html>
