<?php
session_start();
include "messages.php";
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Monsterlite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Monster admin lite design, Monster admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Login</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/teafav.png">
    <!-- Custom CSS -->
    <link href="../../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <link href="../css/auth.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <?php
        $messages = get_messages();
        foreach ($messages as $message) {
            echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
        }
        ?>
        <form class="login" method="post" action="./login_process.php">
            <p class="title">Log in</p>

            <input type="text" placeholder="Grower No/ Clerk No" name="grower_no" required autofocus />
            <i class="fa fa-user"></i>
            <input type="password" placeholder="Password" name="password" required />
            <i class="fa fa-key"></i>
            <a href="#">Forgot your password?</a>
            <button>
                <i class="spinner"></i>
                <span class="state">Log in</span>
            </button>
        </form>
        <footer><a href="./register.php">Don't have an account. Register</a></footer>
        
        </p>
    </div>

    <?php include 'footer.php' ?>
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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
        // var working = false;
        // // Retrieve form data
        // var formData = $(this).serialize();
        // $('.login').on('submit', function (e) {
        //     e.preventDefault();
        //     if (working) return;
        //     working = true;
        //     var $this = $(this),
        //         $state = $this.find('button > .state');
        //     $this.addClass('loading');
        //     $state.html('Authenticating');
        //     setTimeout(function () {
        //         // Send data to PHP file using AJAX
        //         $.ajax({
        //             url: 'process.php', // Replace 'process.php' with the actual path to your PHP file
        //             type: 'POST',
        //             data: formData,
        //             success: function (response) {
        //                 // Handle the response from the PHP file
        //                 // Example: display a success message or redirect to another page
        //                 console.log(response);
        //                 $state.html('Welcome back!');
        //                 $this.addClass('ok');
        //             },
        //             error: function (xhr, status, error) {
        //                 // Handle the error
        //                 // Example: display an error message
        //                 console.error(error);
        //                 $state.html('Login');
        //             },
        //             complete: function () {
        //                 $this.removeClass('loading');
        //                 working = false;
        //             }
        //         });
        //     }, 3000);
        // });
    </script>
</body>

</html>