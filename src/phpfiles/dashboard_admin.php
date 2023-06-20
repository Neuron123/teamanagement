<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
include "conn.php";

// Retrieve the counts from the database
$allFarmersCount = getFarmersCount();
$allClerksCount = getClerksCount();
$deliveredApplicationsCount = getDeliveredApplicationsCount();
$pendingApplicationsCount = getPendingApplicationsCount();
$activeAccountsCount = getActiveAccountsCount();
$inactiveAccountsCount = getInactiveAccountsCount();

// Function to get the count of all farmers
function getFarmersCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM authentication WHERE userrole = 'farmer'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the count of all clerks
function getClerksCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM authentication WHERE userrole = 'clerk'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the count of delivered fertilizer applications
function getDeliveredApplicationsCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM fertilizer WHERE delivered = 'yes'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the count of pending fertilizer applications
function getPendingApplicationsCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM fertilizer WHERE delivered = 'no'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the count of active accounts (users with grower no)
function getActiveAccountsCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM authentication WHERE grower_no != '' AND userrole='farmer' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the count of inactive accounts (users without grower no)
function getInactiveAccountsCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS count FROM authentication WHERE grower_no = '' AND userrole='farmer'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
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
        include "sidebar_admin.php";
        ?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Admin Dashboard</h3>

                        <?php
                        $messages = get_messages();
                        foreach ($messages as $message) {
                            echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
                        }
                        ?>

                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card admincard" id="card1">
                            <div class="card-body">
                                <h4 class="card-title">All Farmers</h4>
                                <h2><?php echo $allFarmersCount ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card admincard" id="card2">
                            <div class="card-body">
                                <h4 class="card-title">All Clerks</h4>
                                <h2><?php echo $allClerksCount ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card admincard" id="card3">
                            <div class="card-body">
                                <h4 class="card-title">Pending Fertilizer Applications</h4>
                                <h2><?php echo $pendingApplicationsCount ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card admincard" id="card4">
                            <div class="card-body">
                                <h4 class="card-title">Delivered Fertilizer Applications</h4>
                                <br />
                                <h2><?php echo $deliveredApplicationsCount ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card admincard" id="card5">
                            <div class="card-body">
                                <h4 class="card-title">Active Accounts<h5>(Farmers with grower no)</h5></h4>
                                <h2><?php echo $activeAccountsCount ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card admincard" id="card6">
                            <div class="card-body">
                                <h4 class="card-title">Inactive Accounts<h5>(Farmers with no grower no)</h5></h4>
                                <h2><?php echo $inactiveAccountsCount; ?></h2>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php include 'footer.php' ?>
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
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="../../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../js/pages/dashboards/dashboard1.js"></script>
</body>

</html>