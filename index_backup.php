<?php
/**
 * Plan & Go - Home Page
 * Main entry point for the website
 */

// Include configuration
require_once 'config.php';
?>

<?php
// Include header
include 'includes/header.php';
?>

<!-- Slider section start -->
<div id="carouselExampleFade" class="carousel slide carousel-fade web" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item wow fadeInRight active">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv1.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="carousel-caption wow bounceInLeft" data-wow-duration="1.5s">
                <h5>
                    Welcome to<br><span>Plan & Go</span>
                </h5>
                <p>PLAN & GO combines thoughtful planning with the freedom to explore.</p>
                <p>We help you plan smart and go farther with confidence.</p>
                <a href="<?php echo BASE_URL; ?>about/" class="btn thm-btn">Read More</a>
            </div>
        </div>
        <div class="carousel-item wow fadeInLeft">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv2.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="carousel-caption wow bounceInLeft" data-wow-duration="1.5s">
                <h5>
                    We Offer<br><span>Domestic & International Tour Packages</span>
                </h5>
                <p>Including ticketing, tailor-made tours and custom made trips with a personal touch.</p>
                <p>Explore the unexplored with offbeat destinations with us.</p>
                <a href="<?php echo BASE_URL; ?>domestic.php" class="btn thm-btn">Read More</a>
            </div>
        </div>
        <div class="carousel-item wow fadeInDown s3">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv3.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="carousel-caption wow bounceInLeft" data-wow-duration="1.5s">
                <h5>
                    We Are<br><span>Passionate</span>
                </h5>
                <p>We are the destination specialist and provides best services.</p>
                <p>We strive to ensure the best quality and uncompromising service excellence.</p>
                <a href="<?php echo BASE_URL; ?>service1/" class="btn thm-btn">Read More</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Slider section end -->

<!-- Slider section start (Mobile) -->
<div id="carouselExampleFadeMobile" class="carousel slide carousel-fade mobile" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item wow fadeInRight active">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv1.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="mcaption">
                <p>PLAN & GO combines thoughtful planning with the freedom to explore.</p>
                <p>We help you plan smart and go farther with confidence.</p>
                <div class="col-12 text-center">
                    <a href="<?php echo BASE_URL; ?>about/" class="btn thm-btn">Read More</a>
                </div>
            </div>
        </div>
        <div class="carousel-item wow fadeInLeft">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv2.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="mcaption">
                <p>Including ticketing, tailor-made tours and custom made trips with a personal touch.</p>
                <p>Explore the unexplored with offbeat destinations with us.</p>
                <div class="col-12 text-center">
                    <a href="<?php echo BASE_URL; ?>domestic.php" class="btn thm-btn">Read More</a>
                </div>
            </div>
        </div>
        <div class="carousel-item wow fadeInDown s3">
            <video class="img-fluid" autoplay loop muted>
                <source src="<?php echo BASE_URL; ?>wp-content/uploads/2023/08/sv3.mp4" type="video/mp4" title="Plan & Go" />
            </video>
            <div class="mcaption">
                <p>We are the destination specialist and provides best services.</p>
                <p>We strive to ensure the best quality and uncompromising service excellence.</p>
                <div class="col-12 text-center">
                    <a href="<?php echo BASE_URL; ?>service1/" class="btn thm-btn">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Slider section end -->

<!-- About Us section start-->
<section class="cta-two">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block-title text-center">
                    <p>Best travel services</p>
                    <h3>We Create Trust <br> We Create Memories</h3>
                </div>
            </div>
            <div class="col-lg-6 wow slideInLeft animated col-md-6">
                <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/aboutus1.webp" class="img-fluid" alt="Plan & Go" title="Plan & Go" width="513" height="450">
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="cta-two__content">
                    <div class="block-title text-left">
                        <p>Best travel services</p>
                        <h3>We Create Trust <br> We Create Memories</h3>
                    </div>
                    <div class="cta-two__content-highlight">
                        <p>Plan & Go Travel believes in Customer satisfaction. We being a travel company always keep our Customer's trust on top because we believe in "Trust us and you will get it double in return". We believe in long life relationship with Customer so that they remember us for their next trip plan.</p>
                        <p>We are passionate, knowledgeable and dedicated to make your holiday memorable. Our efforts and aim are always to inspire our customer to explore the world with unforgettable and Happy memories because Memory is a way of holding onto the things you love.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us section end-->

<!-- Top Destination section start - Dynamic Categories -->
<section class="destinations-three">
    <div class="container">
        <div class="block-title text-center">
            <p>Checkout featured</p>
            <h3>Top Destinations</h3>
        </div>
        <div class="row">
            <!-- Domestic -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="destinations-three__single">
                    <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/Kashmiri.jpg" alt="Domestic" title="Domestic" width="370" height="400" loading="lazy">
                    <div class="destinations-three__content">
                        <h3><a href="<?php echo BASE_URL; ?>domestic.php">Domestic</a></h3>
                    </div>
                    <div class="destinations-three__hover-content">
                        <h3><a href="<?php echo BASE_URL; ?>domestic.php">Kashmir</a></h3>
                        <p>Domestic Tours</p>
                        <a href="<?php echo BASE_URL; ?>domestic.php" class="destinations-three__link"><i class="tripo-icon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            <!-- International -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="destinations-three__single">
                    <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/thailand.webp" alt="International" title="International" width="370" height="400" loading="lazy">
                    <div class="destinations-three__content">
                        <h3><a href="<?php echo BASE_URL; ?>international.php">International</a></h3>
                    </div>
                    <div class="destinations-three__hover-content">
                        <h3><a href="<?php echo BASE_URL; ?>international.php">Thailand</a></h3>
                        <p>International Tours</p>
                        <a href="<?php echo BASE_URL; ?>international.php" class="destinations-three__link"><i class="tripo-icon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            <!-- Unexplored -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="destinations-three__single">
                    <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/09/image10-1.webp" alt="Unexplored" title="Unexplored" width="370" height="400" loading="lazy">
                    <div class="destinations-three__content">
                        <h3><a href="<?php echo BASE_URL; ?>unexplored.php">Unexplored</a></h3>
                    </div>
                    <div class="destinations-three__hover-content">
                        <h3><a href="<?php echo BASE_URL; ?>unexplored.php">Sikkim</a></h3>
                        <p>Offbeat Tours</p>
                        <a href="<?php echo BASE_URL; ?>unexplored.php" class="destinations-three__link"><i class="tripo-icon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            <!-- Weekend Gateways -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="destinations-three__single">
                    <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/hill-station.jpg" alt="Weekend Gateways" title="Weekend Gateways" width="370" height="400" loading="lazy">
                    <div class="destinations-three__content">
                        <h3><a href="<?php echo BASE_URL; ?>weekend_gateways.php">Weekend Gateways</a></h3>
                    </div>
                    <div class="destinations-three__hover-content">
                        <h3><a href="<?php echo BASE_URL; ?>weekend_gateways.php">Quick Getaways</a></h3>
                        <p>Weekend Tours</p>
                        <a href="<?php echo BASE_URL; ?>weekend_gateways.php" class="destinations-three__link"><i class="tripo-icon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Destination section end -->

<!-- Why Choose Us section Start -->
<section class="tour-search-one__home-three">
    <div class="container">
        <div class="block-title text-center">
            <p>Find Adventure That Suits You</p>
            <h3>Why Choose Us</h3>
        </div>
    </div>
</section>
<section class="features-two">
    <div class="features-two__bg" style="background-image: url(<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/images/backgrounds/footer-bg-1-1.webp);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="features-two__single">
                    <div class="round">
                        <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/packages.webp" alt="Customize Packages" title="Customize Packages" width="130" height="130" loading="lazy">
                    </div>
                    <h3>Customize Packages</h3>
                    <hr class="wcs">
                    <p>We offer complete travel solutions including tailor-made tours, ticketing and accommodations with a personal touch.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="features-two__single">
                    <div class="round">
                        <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/offbeatd.webp" alt="Offbeat Destinations" title="Offbeat Destinations" width="130" height="130" loading="lazy">
                    </div>
                    <h3>Offbeat Destinations</h3>
                    <hr class="wcs">
                    <p>There's a lot that travellers can explore in India. Explore the unexplored offbeat destinations with us.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="features-two__single">
                    <div class="round">
                        <img src="<?php echo BASE_URL; ?>wp-content/uploads/2023/06/team.webp" alt="Experienced Team" title="Experienced Team" width="130" height="130" loading="lazy">
                    </div>
                    <h3>Experienced Team</h3>
                    <hr class="wcs">
                    <p>Our travel experts team will put together all of your interest to work out a tour and offer you a never before experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us section End -->

<!-- Service section start -->
<section class="tour-category-one second">
    <div class="container">
        <div class="block-title text-center">
            <p>Featured Services</p>
            <h3>Service We Provide</h3>
        </div>
        <img src="<?php echo BASE_URL; ?>wp-content/themes/De%20La%20Vista%20Travel/assets/images/shapes/aeroplane.webp" class="banner-three__plane-service" alt="Plan & Go Plane" title="Plan & Go Plane">
        <div class="activity-section">
            <div class="activity-inner row">
                <div class="col">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <a><i class="fa fa-hotel"></i></a>
                        </div>
                        <div class="activity-content">
                            <h4><a>Hotel Bookings/Home Stay</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <a><i class="fa fa-plane-departure"></i></a>
                        </div>
                        <div class="activity-content">
                            <h4><a>Flight Bookings</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <a><i class="fa fa-car"></i></a>
                        </div>
                        <div class="activity-content">
                            <h4><a>Car Rental</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <a href="<?php echo BASE_URL; ?>train-search.php"><i class="fa fa-train"></i></a>
                        </div>
                        <div class="activity-content">
                            <h4><a href="<?php echo BASE_URL; ?>train-search.php">Train Booking</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service section end -->

<!-- Feedback Form start -->
<section id="homecform" class="contact-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6 offset-md-6">
                <h2 class="feedback">Drop Us A Line</h2>
                <form action="<?php echo BASE_URL; ?>api/add_inquiry.php" method="post" class="contact-one__form">
                    <div class="row low-gutters">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="name" placeholder="Your Name*" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="phone" placeholder="Phone Number*" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="destination" placeholder="Destination*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <textarea name="message" placeholder="Write Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group text-center">
                                <button type="submit" class="thm-btn contact-one__btn">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Feedback Form end -->

<?php
// Include footer
include 'includes/footer.php';
?>
