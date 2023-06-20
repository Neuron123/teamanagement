<?php
session_start();

include "messages.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $grower_no = $_POST["grower_no"];

    // Update the session variables with new values
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    // Perform any additional database update logic here
    include "conn.php";
    // Prepare and execute the SQL statement to update the user's profile
    $stmt = $conn->prepare("UPDATE authentication SET firstname=?, lastname=?, email=?, phone=? WHERE grower_no=?");
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $phone, $grower_no);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Update the session variables with new values
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        // Show success message
        set_message('Profile updated successfully', 'success');
    } else {
        // Show error message
        set_message('Failed to update profile', 'error');
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
    // Redirect to the profile page
    header("Location: pages-profile.php");
    exit();
}
?>

<?php
include "header.php";
?>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php
        include "navbar.php";
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
        if ($_SESSION['userrole'] == 'admin') {
            include "sidebar_admin.php";
        } else {
            include "sidebar.php";
        }

        ?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Profile</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col">
                        <?php
                        $messages = get_messages();
                        foreach ($messages as $message) {
                            echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
                        }
                        ?>

                        <button class="btn btn-primary" onclick="goBack()">
                            <i class="fa fa-arrow-left"></i> Go Back
                        </button>


                        <!-- <button class="btn btn-primary" href="">
                            <i class="fa fa-home"></i> Go To Dashboard
                        </button> -->

                    </div>
                </div>

                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body profile-card">
                                <center class="mt-4">
                                    <i class="fa fa-user"></i>
                                    <h4 class="card-title mt-2">
                                        <?php echo $_SESSION["firstname"];
                                        echo ' ';
                                        echo $_SESSION["lastname"]; ?>
                                    </h4>
                                    <h6 class="card-subtitle"><?php echo $_SESSION["email"] ?></h6>

                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" method="post"
                                    action="./pages-profile.php">
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="firstname"
                                                value="<?php echo $_SESSION['firstname'] ?>"
                                                class="form-control ps-0 form-control-line" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="lastname"
                                                value="<?php echo $_SESSION['lastname'] ?>"
                                                class="form-control ps-0 form-control-line" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>"
                                                class="form-control ps-0 form-control-line" name="email"
                                                id="example-email" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Grower No/Clerk No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="grower_no"
                                                value="<?php echo $_SESSION['growerno'] ?>"
                                                class="form-control ps-0 form-control-line" readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>"
                                                class="form-control ps-0 form-control-line" required />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12 d-flex">
                                            <button name="submit" type="submit"
                                                class="btn btn-success mx-auto mx-md-0 text-white">Update
                                                Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
            include "footer.php";
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
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
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>