<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
include "conn.php";

$growerNo = $_SESSION['growerno'];

// Get measurements grouped by date
$sql = "SELECT DATE(created_at) AS measurement_date, SUM(quantity) AS sum_quantity FROM tea_measurements WHERE grower_no = ? GROUP BY DATE(created_at)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $growerNo);
$stmt->execute();
$result = $stmt->get_result();
$measurements = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Prepare arrays to store labels and data for the bar graph
$labels = [];
$data = [];

// Calculate the total sum for all measurements
$totalSum = 0;
$todaySum = 0;

foreach ($measurements as $measurement) {
    $date = $measurement['measurement_date'];
    $sum = $measurement['sum_quantity'];

    // Store the label as formatted date (e.g., "Jan 1, 2023")
    $labels[] = date('M j, Y', strtotime($date));
    $data[] = $sum;

    $totalSum += $sum;

    // Check if the measurement is for today
    if (date('Y-m-d', strtotime($date)) === date('Y-m-d')) {
        $todaySum += $sum;
    }
}

$_SESSION['totalsum'] = $totalSum;
$_SESSION['todaysum'] = $todaySum;

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
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>

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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Today Sales</h4>
                                <div class="text-start">
                                    <h2 class="font-light mb-0">
                                        <?php echo $_SESSION["todaysum"]; ?>
                                    </h2>
                                    <span class="text-muted">Todays Kgs</span>
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
                                <h4 class="card-title">Total Sales</h4>
                                <div class="text-start">
                                    <h2 class="font-light mb-0">
                                        <?php echo $_SESSION["totalsum"]; ?>
                                    </h2>
                                    <span class="text-muted">Total Kgs</span>
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kgs vs Days</h4>

                                <!-- bar graph here -->
                                <canvas id="lineGraph"></canvas>

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
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="../../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../js/pages/dashboards/dashboard1.js"></script>
    <script src="../../assets/plugins/chartjs/Chart.js"></script>
    <script>
        $(function () {
            // Line graph data
            var labels = <?php echo json_encode($labels); ?>;
            var data = <?php echo json_encode($data); ?>;

            // Create a line graph
            var ctx = document.getElementById('lineGraph').getContext('2d');
            var lineGraph = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Kgs',
                        data: data,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

    </script>
</body>

</html>