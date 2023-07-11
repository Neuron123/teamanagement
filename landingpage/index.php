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
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   <style>
      .logo::after {
         background-image: url('../assets/images/teafav.png');
         background-position: center;
      }

      .header {
         position: fixed;
         left: 0;
         top: 0;
         width: 100%;
         z-index: 9999;
         /* Ensure the footer is above other elements */
      }

      .footer {
         position: fixed;
         left: 0;
         bottom: 0;
         width: 100%;
         background-color: #f8f8f8;
         padding: 10px 0;
         text-align: center;
         font-size: 14px;
         color: #555;
         border-top: 1px solid #ddd;
         z-index: 9999;
         /* Ensure the footer is above other elements */
      }

      .content-wrapper {
         margin-bottom: 50px;
         /* Adjust the margin to accommodate the footer's height */
      }

      html,
      body {
         height: 100%;
      }

      .main-layout {
         min-height: 100%;
         display: flex;
         flex-direction: column;
      }

      .content-wrapper {
         flex: 1;
         margin-bottom: 50px;
         /* Adjust the margin to accommodate the footer's height */
      }

      .copyright {
         margin-top: unset;
      }

      ul.link li a {
         color: #1063ff;
      }

      .footer-links {
         margin-bottom: 7%;
      }
   </style>
</head>
<!-- body -->

<body class="main-layout">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
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
                           <a href="index.php" style="color: #fff;font-size: 20px;text-align: left;">
                              <!-- Add the system name here -->
                              TMS
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item active">
                              <a class="nav-link" href="index.php"> Home </a>
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
                        </ul>
                        <ul class="navbar-nav ml-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="../src/phpfiles/login2.php">LOGIN</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="../src/phpfiles/register2.php">REGISTER</a>
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
      <div style='background-color: rgba(0, 0, 0, 0.7);margin: 20px;'>
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="text-bg">
                     <h1>TEA MANAGEMENT</h1>
                     <p>Streamline Your Tea Management Process
                        Efficient Tea Records and Fertilizer Applications</p>
                     <a href="../index.php">Get Started</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end banner -->
   <!-- three_box -->
   <div class="three_box">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <div class="box_text">
                  <figure><img src="../assets/images/tea.webp" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box_text">
                  <figure><img src="../assets/images/tea2.jpeg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box_text">
                  <figure><img src="../assets/images/tea3.jpeg" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end three_box -->
   <!-- choose  section -->
   <div class="choose ">
      <div class="container-fluid" id="aboutus">
         <div class="row d_flex">
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
               <div class="padding_with">
                  <div class="row">
                     <div class="col-md-6 padding_bottom">
                        <div class="choose_box">
                           <i><img src="images/icon1.png" alt="#" /></i>
                           <div class="choose_text">
                              <h3>1. Site Preparation:</h3>
                              <p>
                                 Proper planning of the tea plantation is crucial for optimizing yield and ensuring
                                 optimal plant growth.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 padding_bottom">
                        <div class="choose_box">
                           <i><img src="images/icon2.png" alt="#" /></i>
                           <div class="choose_text">
                              <h3>2. Planting</h3>
                              <p>
                                 Set up a nursery to grow tea seedlings or propagate tea plants through cuttings
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 padding_bottom2">
                        <div class="choose_box">
                           <i><img src="images/icon1.png" alt="#" /></i>
                           <div class="choose_text">
                              <h3>3. Maintenance</h3>
                              <p>Apply appropriate fertilizers to provide essential nutrients to the tea plants.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="choose_box">
                           <i><img src="images/icon4.png" alt="#" /></i>
                           <div class="choose_text">
                              <h3>4. Harvesting</h3>
                              <p>Harvest the tea leaves when they reach the desired maturity</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
               <div class="choose_img">
                  <figure><img src="../assets/images/tea.gif" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end choose  section -->
   </div>

   <!--contact us -->
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
                        <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                  <div class="col-md-8">
                     <textarea class="contactus1" placeholder="Message" type="type" Message="Name">Message </textarea>
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
               <li><a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></a> +71 9087654321
               </li>
               <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>demo@gmail.com</li>
            </ul>
         </div>
         <div class="col-md-3 border_right footer-links">
            <h3>Useful Link</h3>
            <ul class="link">
               <li><a href="#">Home </a></li>
               <li><a href="#">About </a> </li>
               <li><a href="#">Features </a></li>
               <li><a href="#">Contact </a> </li>
            </ul>
         </div>
         <div class="col-md-3 border_right footer-links">
            <h3>Menus</h3>
            <ul class="link">
               <li><a href="index.php">Home</a></li>
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
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>