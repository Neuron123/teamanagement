<?php
session_start();
include "messages.php";
?>


<?php
include "header.php";
?>

<?php
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

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $totalQuantity = 0;
        $rowCount = 0;

        // Iterate over the fetched rows
        while ($row = $result->fetch_assoc()) {
            // Access the data here
            $totalQuantity += $row['quantity'];
            $rowCount++;
            // ...
        }

        // Calculate the average quantity
        $averageQuantity = $totalQuantity / $rowCount;
        $_SESSION['average_kgs'] = $averageQuantity;

    } else {
        // No rows found
        //echo "No records found.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Show error message
    //echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<?php
include "conn.php";
// Prepare the SQL statement
$sql = "SELECT * FROM fertilizer WHERE grower_no = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the grower_no value
    $stmt->bind_param("s", $_SESSION['growerno']);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        $previousApplications = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $previousApplications = [];
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
                        <h3 class="page-title mb-0 p-0">Fertilizer</h3>

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
                                    <li class="breadcrumb-item active" aria-current="page">Fertilizers</li>
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

                                <button class="btn btn-primary" id="addrecordbtn"
                                    style="position:absolute;right:25px;color:white;z-index:1000;"
                                    data-bs-toggle="modal" data-bs-target="#addRecordModal">
                                    <i class="fas fa-plus"></i> Apply For Fertilizer
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addRecordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addRecordModalLabel">Make an Application
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="fertilizer_process.php" onsubmit="return validateForm()">

                                                    <div class="mb-3">
                                                        <label for="inputName" class="form-label">Grower No</label>
                                                        <input type="hidden" name="grower_no"
                                                            value="<?php echo $_SESSION['growerno'] ?>" />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="inputkgs" class="form-label">
                                                            Quantity (This number is auto-calculated based on your
                                                            average weights)
                                                        </label>
                                                        <input type="number" name="quantity" class="form-control"
                                                            id="inputkgs" min="1"
                                                            value="<?php echo $_SESSION['average_kgs'] ?>" readonly required/>
                                                    </div>

                                                    <?php
                                                    // Fetch the rate_per_kgs from the latest record in the fertilizer_rate table
                                                    include "conn.php";
                                                    $sql = "SELECT rate_per_kgs FROM fertilizer_rate ORDER BY id DESC LIMIT 1";
                                                    $result = $conn->query($sql);
                                                    if ($result && $result->num_rows > 0) {
                                                        $row = $result->fetch_assoc();
                                                        $ratePerKgs = $row['rate_per_kgs'];
                                                    } else {
                                                        $ratePerKgs = 0;
                                                    }
                                                    ?>


                                                    <div class="mb-3">
                                                        <label for="inputRate" class="form-label">
                                                            Rate per Kgs
                                                        </label>
                                                        <input type="number" name="rate" class="form-control"
                                                            id="inputRate" min="1" value="<?php echo $ratePerKgs ?>"
                                                            readonly />
                                                    </div>

                                                    <!-- Calculate the total amount based on quantity and rate_per_kgs -->
                                                    <?php
                                                    $totalAmount = $_SESSION['average_kgs'] * $ratePerKgs;
                                                    ?>

                                                    <div class="mb-3">
                                                        <label for="inputAmount" class="form-label">
                                                            Total Amount
                                                        </label>
                                                        <input type="text" class="form-control" id="inputAmount" name="amount"
                                                            value="<?php echo $totalAmount ?>" min="1" readonly required/>
                                                    </div>


                                                    <!-- Add more form fields as needed -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <h4 class="card-title">Previous Fertilizer Applications</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap" id="recordtable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">Amount</th>
                                                <th class="border-top-0">Date Applied</th>
                                                <th class="border-top-0">Delivered</th>
                                                <th class="border-top-0">Date Delivered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($previousApplications as $index => $record) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $index + 1; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['amount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['created_at']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['delivered']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['date_delivered']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

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
            t.on('order.dt search.dt', function () {
                t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>

    <script>
        function validateForm() {
        // Retrieve the total amount value
        var totalAmount = parseFloat(document.getElementById('inputAmount').value);
        
        // Check if the total amount is 0 or less
        if (totalAmount <= 0) {
            alert('Total amount must be greater than 0');
            return false; // Prevent form submission
        }
        
        // Allow form submission if the total amount is greater than 0
        return true;
    }
</script>
</body>

</html>