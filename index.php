<?php
header("Access-Control-Allow-Origin: *");
include("../__lib.includes/config.inc.php"); 
?>
<!doctype html>
<html class="no-js" lang="zxx">



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>404 - Page </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/flaticon.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/nice-select.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/animate.min.css">
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/slicknav.css"> 
    <link rel="stylesheet" href="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>css/style.css">

</head>

<body class="home_3 home">
   
               <!-- header_start -->
    <header>
        <div id="sticky-header" class="header_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header__wrapper">
                            <!-- header__left__start  -->
                            
                            <div class="header__left">
                                <div class="logo_img">
                                    <a href="home.html">
                                        <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/logo_3.png" alt="">
                                    </a>
                                </div>
                                <div class="logo_img_2">
                                    <a href="home.html">
                                        <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/black-logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- header__left__start  -->
    
                            <!-- main_menu_start  -->
                            <div class="main_menu text-center d-none d-lg-block">
                                <nav>
                                    <ul id="mobile-menu">
                                    
                                        <li><a href="#">Tax</a></li>
                                        <li><a href="#">Investments</a></li>
                                        <li><a href="createwill.html">Will</a></li>
                                        <li><a href="#">Resource</a>
                                    
                                        <ul class="submenu">
                                             <li><a href="#">Knowledge</a></li>
                                              <li><a href="#">FAQ</a></li>
                                        </ul>
                                        </li>
                                        <li><a href="contact.html">contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- main_menu_start  -->
    
                            <!-- header__right_start  -->
                            <div class="header__right">
                                <div class="contact_wrap d-flex align-items-center">
                                   
                                    <div class="contact_btn d-none d-lg-block">
                                        <a href="#" class="boxed_btn paste_btn sign_in" data-toggle="modal" data-target="#login_form">Login</a>
                                    </div>
                                </div>
                            </div>
                            <!-- header__right_end  -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header_end -->

    <!-- page_not_found_wrap_start  -->
    <div class="page_not_found_wrap">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-8">
                    <div class="not_found_wrap text-center">
                        <div class="thumb wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/404.png" alt="">
                        </div>
                        <div class="info_404 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <h3 >Oops! Page not Found</h3>
                            <p>Don't worry! We will get back soon</p>
                            <a href="home.html" class="boxed_btn_2">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page_not_found_wrap_end  -->

     <!-- footer_start -->
    <footer>
        <div class="ilstrator_footer_img d-none d-lg-block ">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/banner/footer_ils_1.png" alt="">
        </div>
        <div class="anim_icon ">
            <div class="anim_icon_1 amination_custom">
                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/4.png" alt="">
            </div>
            <div class="anim_icon_2 amination_custom11">
                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/5.png" alt="">
            </div>
        </div>
        <div class="footer_top_area">
            <div class="container-fluid footer-padding">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/black-logo.png" alt="">
                                </a>
                            </div>
                           
                            <div class="social_links">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                    <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                              
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <div class="footer_title">
                                <h3>WHO WE ARE/COMPANY</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Media Coverage & Recognitions</a></li>
                                <li><a href="#">Partners</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>OUR SERVICES</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">ITR Filling</a></li>
                                <li><a href="#"> NRI Filling</a></li>
                                <li><a href="#">Notice Assistance</a></li>
                                <li><a href="#">Investments</a></li>
                                <li><a href="#">Will</a></li>
                                <li><a href="#">E-locker</a></li>
                                <li><a href="#">Pricing</a></li>
                            </ul>
                        </div>
                    </div> 
                    
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>EXPLORE</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">Top Investment Options</a></li>
                                <li><a href="#">Mutual Funds Explorer</a></li>
                                <li><a href="#">Mutual Fund Categories</a></li>
                                <li><a href="#">Help & Support</a></li>
                                
                            </ul>
                        </div>
                    </div> 
                    
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>RESOURCES</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">Blogs and Bulletin</a></li>
                                <li><a href="#"> FAQ & Knowledge Center</a></li>
                                <li><a href="#">Calculators</a></li>
                                <li><a href="#">Plan Your Goals</a></li>
                                <li><a href="#">Utilities & Tools</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div> 
                   
                </div>
            </div>
        </div>
        <div class="copyright_area">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="copy_right_text wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <p>
                                    © 2020 Optymoney. All rights reserved.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="copy_right_links wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <ul>
                                <li>
                                    <a href="#">Company Terms</a>
                                    <a href="#">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a href="https://api.whatsapp.com/send?phone=9876543210" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i></a>

 <a href="#" class="float_chat" target="_blank">
<i class="fa fa-comment my-float"></i></a>
            </div>
        </div>
        
        
 <!-- Login Form -->
    <div class="modal fade custom_login_from" id="login_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Login</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                
                                <div class="single_input">
                                    <input type="email" placeholder="Email Address" >
                                </div>
                                <div class="single_input">
                                    <input type="password" placeholder="Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Login</button>
                                </div>
                                <div class="forgot_pass">
                                    <p><a href="#" class="sign_in" data-toggle="modal" data-target="#forgot_password">Forget Password?</a></p>
                                    <p>Don't have an account? <a class="sign_in" data-toggle="modal" data-target="#signupp" href="#">Sign Up</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Login Form -->

 <!-- Forgot Password -->
    <div class="modal fade custom_login_from" id="forgot_password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Reset Password</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                
                                <div class="single_input">
                                    <input type="email" placeholder="Email Address" >
                                </div>
                               
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Reset Password</button>
                                </div>
                               
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Forgot Password -->
 <!-- start now -->
    <div class="modal fade custom_login_from" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Sign Up</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                <div class="single_input">
                                    <input type="text" placeholder="Name" >
                                </div>
                                <div class="single_input">
                                    <input type="email" placeholder="Enter your email" >
                                </div>
                                <div class="single_input">
                                    <input type="tel" placeholder="Phone Number" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ start now -->

 <!-- signup -->
    <div class="modal fade custom_login_from" id="signupp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Sign Up</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                <div class="single_input">
                                    <input type="text" placeholder="Name" >
                                </div>
                                <div class="single_input">
                                    <input type="email" placeholder="Enter your email" >
                                </div>
                                <div class="single_input">
                                    <input type="tel" placeholder="Phone Number" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Request OTP</button>
                                </div>
                                 <div class="single_input">
                                    <input type="password" placeholder="Password" >
                                </div>
                                 <div class="single_input">
                                    <input type="tel" placeholder="Confirm Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ signup -->
    </footer>
    <!-- footer_end -->
   

    <!--All JS here -->
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/popper.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/isotope.pkgd.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/waypoints.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.counterup.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/wow.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/nice-select.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.slicknav.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/parallax.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/plugins.js"></script>

    <!-- main js  -->
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main.js"></script>

</body>



</html>