<?php
session_start();
include "messages.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>TMS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../landingpage/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../landingpage/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../landingpage/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../landingpage/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
        .logo::after {
            background-image: url('../../assets/images/teafav.png');
            background-position: center;
        }

        .banner_main {
            background-image: unset;
            min-height: 400px;
        }

        .form-control {
            border: 2px solid black;
        }

        .form-control:focus {
            border-color: #ced4da !important;
            box-shadow: none;
        }

        input:focus {
            border: 1px solid black;
        }

        .wrapper {
            width: 40%;
        }
    </style>
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="../../landingpage/images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <!-- <a href="index.php"></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.html"> Home </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#aboutus">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#features">Features</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#contact">Contact</a>
                                    </li>
                                    <!-- <li class="nav-item d_none">
                                 <a class="nav-link" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                              </li> -->
                                    <li class=" d_none get_btn">
                                        <a href="../phpfiles/login2.php">LOGIN</a>
                                    </li>
                                    <li class=" d_none get_btn">
                                        <a href="../phpfiles/register2.php">REGISTER</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <!-- banner -->
    <section class="banner_main">
        <div class="wrapper">
            <?php
            $messages = get_messages();
            foreach ($messages as $message) {
                echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
            }
            ?>
            <form class="login" method="post" action="./login_process.php">
                <p class="title">Log in</p>

                <div class="form-group">
                    <label>Grower No/Clerk No</label>
                    <input type="text" name="grower_no" class="form-control" required autofocus />
                </div>
                <!-- <i class="fa fa-user"></i> -->

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required autofocus />
                </div>


                <a href="#">Forgot your password?</a>

                <div class="form-group" style="float:right;padding:17px;">
                    <button class="btn btn-primary">
                        <i class="spinner"></i>
                        <span class="state">Log in</span>
                    </button>
                </div>

            </form>
            <footer><a href="./register2.php">Don't have an account. Register</a></footer>

            </p>
        </div>
    </section>
    <!-- end banner -->

    </div>
    </div>
    <!-- end hottest -->
    <!-- choose  section -->

    <!-- end about -->
    </div>
    <!--  footer -->
    <footer id="contact">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="titlepage">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form id="request" class="main_form">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <input class="contactus" placeholder="Full Name" type="type" name="Full Name">
                                </div>
                                <div class="col-md-3">
                                    <input class="contactus" placeholder="Email" type="type" name="Email">
                                </div>
                                <div class="col-md-3">
                                    <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <ul class="social_icon">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="contactus1" placeholder="Message" type="type"
                                        Message="Name">Message </textarea>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <button class="send_btn">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 border_right">
                        <ul class="location_icon">
                            <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a> Nairobi, Kenya</li>
                            <li><a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></a> +71
                                9087654321
                            </li>
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>demo@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-3 border_right">
                        <h3>Useful Link</h3>
                        <ul class="link">
                            <li><a href="#">Home </a></li>
                            <li><a href="#">About </a> </li>
                            <li><a href="#">Features </a></li>
                            <li><a href="#">Contact </a> </li>
                            <!-- <li><a href="#">believable. If   </a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-3 border_right">
                        <h3>Menus</h3>
                        <ul class="link">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#aboutus">About</a></li>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <form class="bottom_form">
                            <h3>Newsletter</h3>
                            <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                            <button class="sub_btn">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Copyright 2023. Built by <a href="#"> Eddah</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="../../landingpage/js/jquery.min.js"></script>
    <script src="../../landingpage/js/popper.min.js"></script>
    <script src="../../landingpage/js/bootstrap.bundle.min.js"></script>
    <script src="../../landingpage/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="../../landingpage/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../landingpage/js/custom.js"></script>
</body>

</html>