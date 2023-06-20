<?php
session_start();
include "messages.php";
?>


<?php
include "header.php";
?>

<?php
// Prepare the SQL statement
include "conn.php";
// Prepare the SQL statement
$sql = "SELECT * FROM tea_measurements WHERE grower_no = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the grower_no value
    $stmt->bind_param("s", $_SESSION['growerno']);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Initialize an empty array to store the fetched records
    $records = array();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch the rows as an associative array and store them in the $records array
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        // No rows found
        echo "No records found.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Show error message
    echo "Error: " . $conn->error;
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
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
        include "sidebar.php";
        ?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">All Records</h3>

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
                                    <li class="breadcrumb-item active" aria-current="page">Table</li>
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
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">


                                <h4 class="card-title">Tea Records</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap" id="recordtable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">Grower No</th>
                                                <th class="border-top-0">Quantity</th>
                                                <th class="border-top-0">Date Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Initialize the row number counter
                                            $rowNumber = 1;
                                            // Iterate over the fetched records
                                            foreach ($records as $record) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $rowNumber; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['grower_no']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['quantity']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['created_at']; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                // Increment the row number counter
                                                $rowNumber++;
                                                // Update the total amount
                                                $totalAmount += $record['quantity'];
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <h2 class="text-right">Totals:<?php echo $totalAmount ?></h2>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="../../assets/plugins/datatable.js"></script>
    <script>
        $(document).ready(function () {
            var t = $('#recordtable').DataTable();
            var counter = 1;

            $('#addRow').on('click', function () {
                t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5']).draw(false);

                counter++;
            });

            // Automatically add a first row of data
            $('#addRow').click();
        });
    </script>
</body>

</html>