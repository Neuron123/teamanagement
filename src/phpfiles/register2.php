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

    <link href="../../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.min.css" rel="stylesheet">
    <!-- <link href="../css/auth.css" rel="stylesheet" /> -->
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
            <form class="login" id="regformid" method="post" action="./register_process.php">
                <h4 class="title">Registration Form</h4>

                <select class="form-control" name="userrole" id="roleid">
                    <option value="farmer">Farmer</option>
                    <option value="clerk">Clerk</option>
                </select>
                <br />

                <select class="form-control" id="choicesid" required>
                    <option value="">Do you have a grower no </option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <br />

                <div class="form-group" id="growerid">
                    <label>Grower No/Clerk No</label>
                    <input type="number" placeholder="" class="form-control" name="grower_no" />
                </div>

                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" placeholder="" name="firstname" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" placeholder="" name="lastname" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="" name="password" id="password1" class="form-control"
                        required />
                </div>

                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" placeholder="" class="form-control" id="password2" required />
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="number" placeholder="" name="phone" id="phone" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="" name="email" id="email" class="form-control" required />
                </div>

                <div class="form-group" style="float:right;padding:17px;">
                    <button class="btn btn-primary">
                        <i class="spinner"></i>
                        <span class="state">Register</span>
                    </button>
                </div>

            </form>
            <footer><a href="./login2.php">Login</a></footer>

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
    <script src="../js/pages/register.js"></script>
    <script src="../../landingpage/js/jquery.min.js"></script>
    <script src="../../landingpage/js/popper.min.js"></script>
    <script src="../../landingpage/js/bootstrap.bundle.min.js"></script>
    <script src="../../landingpage/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="../../landingpage/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../landingpage/js/custom.js"></script>

    <script src="../js/pages/register.js"></script>
    <script src="../js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="../../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../js/pages/dashboards/dashboard1.js"></script>

    <script>
        // Function to validate the form
        function validateForm() {
            var growerNo = document.getElementById("growerid").value;
            var firstname = document.getElementsByName("firstname")[0].value;
            var lastname = document.getElementsByName("lastname")[0].value;
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;
            var phone = document.getElementById("phone").value;
            var email = document.getElementById("email").value;

            var isValid = true;

            // Validate growerNo (not empty)
            if (growerNo.trim() === "") {
                isValid = false;
                document.getElementById("growerid").classList.add("error");
            } else {
                document.getElementById("growerid").classList.remove("error");
            }

            // Validate firstname (not empty and only letters)
            if (firstname.trim() === "" || !isValidName(firstname)) {
                isValid = false;
                document.getElementsByName("firstname")[0].classList.add("error");
            } else {
                document.getElementsByName("firstname")[0].classList.remove("error");
            }

            // Validate lastname (not empty and only letters)
            if (lastname.trim() === "" || !isValidName(lastname)) {
                isValid = false;
                document.getElementsByName("lastname")[0].classList.add("error");
            } else {
                document.getElementsByName("lastname")[0].classList.remove("error");
            }

            // Validate password (not empty and match)
            if (password1.trim() === "" || password1 !== password2) {
                isValid = false;
                document.getElementById("password1").classList.add("error");
                document.getElementById("password2").classList.add("error");
            } else {
                document.getElementById("password1").classList.remove("error");
                document.getElementById("password2").classList.remove("error");
            }

            // Validate phone (not empty and at least 10 digits)
            if (phone.trim() === "" || phone.length < 10) {
                isValid = false;
                document.getElementById("phone").classList.add("error");
            } else {
                document.getElementById("phone").classList.remove("error");
            }

            // Validate email (not empty and valid format)
            if (email.trim() === "" || !isValidEmail(email)) {
                isValid = false;
                document.getElementById("email").classList.add("error");
            } else {
                document.getElementById("email").classList.remove("error");
            }

            return isValid;
        }

        // Function to validate name (only letters)
        function isValidName(name) {
            var nameRegex = /^[a-zA-Z]+$/;
            return nameRegex.test(name);
        }

        // Function to validate email format
        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>


</body>

</html>