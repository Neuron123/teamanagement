<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
require "conn.php";

// Query to retrieve the most recent transactions from the tea_measurements table
$sql = "SELECT * FROM tea_measurements ORDER BY created_at DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Initialize variables for total amount and total count
    $totalAmount = 0;
    $totalCount = 0;

    // Initialize an array to store the transaction data
    $recentTransactions = array();

    // Fetch the rows from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Store each row in the recentTransactions array
        $recentTransactions[] = $row;

        // Calculate the total amount by summing the transaction amounts
        $totalAmount += $row['quantity'];

        // Increment the total count
        $totalCount++;
    }

    // Calculate the average amount
    $averageAmount = ($totalCount > 0) ? $totalAmount / $totalCount : 0;

    $_SESSION['totalAmount'] = $totalAmount;
    $_SESSION['averageAmount'] = $averageAmount;

    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);
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
        include "sidebar.php";
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Clerk Dashboard</h3>

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
                                    <li class="breadcrumb-item active" aria-current="page">Clerk</li>
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Weights</h4>
                                <div class="text-start">
                                    <h2 class="font-light mb-0"> <?php echo $_SESSION['totalAmount'] ?> </h2>
                                    <span class="text-muted">Total Weight of Tea Leaves</span>
                                </div>
                                <span class="text-success"></span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Average Weights</h4>
                                <div class="text-start">
                                    <h2 class="font-light mb-0"> <?php echo $_SESSION['averageAmount'] ?></h2>
                                    <span class="text-muted">Average Weight of Tea Leaves</span>
                                </div>
                                <span class="text-info"></span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php include "calendar.php" ?>
                                </div>

                                <div class="col-sm-6" style="line-height:40px;">
                                    <br />
                                    <h4>Recent Transactions</h4>
                                    <table class="table">
                                        <thead>
                                            <th>No</th>
                                            <th>Grower No</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Check if there are any recent transactions
                                            if (!empty($recentTransactions)) {
                                                // Counter variable for numbering the rows
                                                $counter = 1;

                                                // Loop through the recentTransactions array and display the transaction details
                                                foreach ($recentTransactions as $transaction) {
                                                    // Access the transaction data using the column names
                                                    $growerNo = $transaction['grower_no'];
                                                    $transactionDate = $transaction['created_at'];

                                                    // Display the transaction details within table rows
                                                    echo "<tr>";
                                                    echo "<td>" . $counter . "</td>";
                                                    echo "<td>" . $growerNo . "</td>";
                                                    echo "<td>" . $transactionDate . "</td>";
                                                    echo "</tr>";

                                                    // Increment the counter
                                                    $counter++;
                                                }
                                            } else {
                                                // Display a message if no recent transactions found
                                                echo "<tr>";
                                                echo "<td colspan='3'>No recent transactions found.</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- column -->
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            © 2023 Tea Management System by <a href="#">Eddah</a>
        </footer>
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
    <script src="../../assets/plugins/chartjs/Chart.js"></script>

    <script>
        function logout() {
            // Send an AJAX request to the PHP function
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'logout.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response here, if needed
                    // For example, you can redirect the user to another page
                    window.location.href = 'login2.php';
                }
            };
            xhr.send();
        }
    </script>

</body>

</html>