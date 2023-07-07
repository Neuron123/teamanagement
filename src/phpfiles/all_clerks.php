<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
include "conn.php";

// Fetch all farmers from the authentication table with the role 'farmer'
$query = "SELECT * FROM authentication WHERE userrole = 'clerk'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Initialize an empty array to store the farmers
    $farmers = array();

    // Fetch each row and add it to the farmers array
    while ($row = mysqli_fetch_assoc($result)) {
        $farmers[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Query execution failed
    $farmers = array(); // Set an empty array if no farmers found or an error occurred
}

// Close the database connection
$conn->close();
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
        <?php
        include "sidebar_admin.php";
        ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ...existing code... -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">All Clerks</h3>
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
                                    <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                                    <!-- Add the link to the previous page -->
                                    <li class="breadcrumb-item active" aria-current="page">All Clerks</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ...existing code... -->

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Farmers</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap" id="recordtable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">Firstname</th>
                                                <th class="border-top-0">Lastname</th>
                                                <th class="border-top-0">Phone</th>
                                                <th class="border-top-0">Email</th>
                                                <th class="border-top-0">Reg Date</th>
                                                <th class="border-top-0">Clerk No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                            foreach ($farmers as $farmer) {
                                                echo "<tr>";
                                                echo "<td>{$index}</td>";
                                                echo "<td>{$farmer['firstname']}</td>";
                                                echo "<td>{$farmer['lastname']}</td>";
                                                echo "<td>{$farmer['phone']}</td>";
                                                echo "<td>{$farmer['email']}</td>";
                                                echo "<td>{$farmer['created_at']}</td>";
                                                echo "<td>{$farmer['grower_no']}</td>";
                                                echo "</tr>";
                                                $index++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
            include "footer.php";
            ?>
        </div>
    </div>

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
    <script src="../../assets/plugins/datatable.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>