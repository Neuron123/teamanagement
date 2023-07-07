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
    <title>Register</title>
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
        <form class="login" id="regformid" method="post" action="./register_process.php">
            <p class="title">Register</p>

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

            <input type="text" placeholder="Grower No/Clerk No" name="grower_no" id="growerid" autofocus />
            <i class="fa fa-user"></i>

            <input type="text" placeholder="Firstname" name="firstname" required autofocus />
            <i class="fa fa-user"></i>

            <input type="text" placeholder="Lastname" name="lastname" required autofocus />
            <i class="fa fa-user"></i>

            <input type="password" placeholder="Password" name="password" id="password1" required />
            <i class="fa fa-key"></i>
            <p id="msgpwd"></p>

            <input type="password" placeholder="Repeat Password" id="password2" required />
            <i class="fa fa-key"></i>

            <input type="number" placeholder="Phone" name="phone" required />
            <i class="fa fa-key"></i>

            <input type="email" placeholder="Email" name="email" required />
            <i class="fa fa-key"></i>



            <!-- <button>
                <i class="spinner"></i>
                <span class="state">Register</span>
            </button> -->
            <input type="submit" name="submit" value="Register" class="btn btn-primary" />
        </form>
        <footer><a href="./login.php">Go To Login</a></footer>
        </p>
    </div>

    <?php include 'footer.php' ?>
    <script src="../js/pages/register.js"></script>
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
        function validateForm() {
            var growerNo = document.getElementById("growerid").value;
            var firstname = document.getElementsByName("firstname")[0].value;
            var lastname = document.getElementsByName("lastname")[0].value;
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;
            var phone = document.getElementsByName("phone")[0].value;
            var email = document.getElementsByName("email")[0].value;

            var isValid = true;

            // Validate growerNo (not empty)
            if (growerNo.trim() === "") {
                isValid = false;
                document.getElementById("growerid").classList.add("error");
            } else {
                document.getElementById("growerid").classList.remove("error");
            }

            // Validate firstname (not empty and only letters)
            if (firstname.trim() === "" || !isValidLetters(firstname)) {
                isValid = false;
                document.getElementsByName("firstname")[0].classList.add("error");
            } else {
                document.getElementsByName("firstname")[0].classList.remove("error");
            }

            // Validate lastname (not empty and only letters)
            if (lastname.trim() === "" || !isValidLetters(lastname)) {
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
            if (phone.trim() === "" || !isValidPhoneNumber(phone)) {
                isValid = false;
                document.getElementsByName("phone")[0].classList.add("error");
            } else {
                document.getElementsByName("phone")[0].classList.remove("error");
            }

            // Validate email (not empty and valid format)
            if (email.trim() === "" || !isValidEmail(email)) {
                isValid = false;
                document.getElementsByName("email")[0].classList.add("error");
            } else {
                document.getElementsByName("email")[0].classList.remove("error");
            }

            return isValid;
        }

        function isValidLetters(value) {
            var lettersRegex = /^[A-Za-z]+$/;
            return lettersRegex.test(value);
        }

        function isValidPhoneNumber(phone) {
            var phoneRegex = /^\d{10,}$/;
            return phoneRegex.test(phone);
        }

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>



</body>

</html>