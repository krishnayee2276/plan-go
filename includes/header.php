<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plan & Go || Travel Website</title>
    <link rel="icon" href="<?php echo BASE_URL; ?>wp-content/uploads/2023/07/planngo.jpg" type="image/png">
    <link rel="manifest" href="<?php echo BASE_URL; ?>assets/images/favicons/site.html">

    <!-- plugin scripts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:200,300,400,400i,500,600,700,800,900%7CSatisfy&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/jquery.mCustomScrollbar.min.css">
    <!-- template styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/css/responsive.css">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-NCX9FPRX');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YBBHVDKXHL"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'G-YBBHVDKXHL');</script>
</head>

<style>
/* ===== FINAL BREADCRUMB FIX ===== */
.thm-breadcrumb {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 13px;
    text-transform: uppercase;
    list-style: none;
    padding: 0;
    margin: 15px 0 0;
}
/* spacing for items */
.thm-breadcrumb li {
    color: #fff;
    font-weight: 500;
}
/* add clean slash between items */
.thm-breadcrumb li:not(:last-child)::after {
    content: " / ";
    color: rgba(255,255,255,0.7);
    margin: 0 10px;
}
/* remove any theme-generated separators */
.thm-breadcrumb li::before {
    content: none !important;
}
</style>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCX9FPRX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="page-wrapper">
        <div class="site-header__header-one site-header__home-two-wrap">
            <header class="main-nav__header-one site-header__home-two ">
                <nav class="header-navigation stricky">
                    <div class="container">
                        <div class="main-nav__logo-box">
                            <a href="<?php echo BASE_URL; ?>" class="main-nav__logo">
                                <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/07/planngo.jpg" class="main-logo" width="200" height="150" alt="Plan & Go Logo" title="Plan & Go" loading="lazy">
                            </a>
                            <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i></a>
                        </div>
                        <a href="#" class="side-menu__toggler" aria-label="side menu"><i class="fa fa-bars"></i></a>
                        <div class="main-nav__main-navigation">
                            <div class="row">
                                <div class="col">
                                    <div class="topbar-one">
                                        <div class="container-fluid">
                                            <div class="topbar-one__left"></div>
                                            <div class="topbar-one__right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <ul class="main-nav__navigation-box">
                                        <ul id="primary-menu" class="main-nav__navigation-box">
                                            <li class="menu-item"><a href="<?php echo BASE_URL; ?>" class="nav-link">Home</a></li>
                                            <li class="menu-item"><a href="<?php echo BASE_URL; ?>about/" class="nav-link">About</a></li>    
                                            <li class="menu-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Destinations</a>
                                                <div class="dropdown-menu">
                                                    <a href="<?php echo BASE_URL; ?>packages.php?cat=domestic" class="dropdown-item">Domestic</a>
                                                    <a href="<?php echo BASE_URL; ?>packages.php?cat=international" class="dropdown-item">International</a>
                                                    <a href="<?php echo BASE_URL; ?>packages.php?cat=unexplored" class="dropdown-item">Unexplored</a>
                                                    <a href="<?php echo BASE_URL; ?>packages.php?cat=weekend_gateways" class="dropdown-item">Weekend Gateways</a>     
                                                </div>
                                            </li>
                                            <li class="menu-item"><a href="<?php echo BASE_URL; ?>service1/" class="nav-link">Services</a></li>
                                            <li class="menu-item"><a href="<?php echo BASE_URL; ?>inquiry/" class="nav-link">Inquiry Now</a></li>
<li class="menu-item"><a href="flight_booking.php" class="nav-link">Flights</a></li>
                                            <li class="menu-item"><a href="<?php echo BASE_URL; ?>contact/" class="nav-link">Contact</a></li>                                        
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
