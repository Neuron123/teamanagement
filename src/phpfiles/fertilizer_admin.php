<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
include "conn.php";

// Fetch all fertilizer applications
$sql = "SELECT * FROM fertilizer";
$result = $conn->query($sql);
$applications = $result->fetch_all(MYSQLI_ASSOC);


// Fetch the latest fertilizer rate
$sql = "SELECT rate_per_kgs FROM fertilizer_rate ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$latestRate = $result->fetch_assoc();

// Close the database connection
$conn->close();


?>

<!-- Rest of your code -->

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <!-- Preloader content goes here -->
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include "navbar.php"; ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include "sidebar_admin.php"; ?>
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
                <!-- Breadcrumb content goes here -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Fertilizer Applications table -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Set Rate section -->
                <!-- ============================================================== -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $messages = get_messages();
                                foreach ($messages as $message) {
                                    echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
                                }
                                ?>

                                <h4 class="card-title">Set Rate</h4>
                                <form action="fertilizer_rate.php" method="POST">
                                    <div class="form-group">
                                        <label for="rate_per_kgs">Rate per 100kgs:</label>
                                        <input type="text" name="rate_per_kgs" id="rate_per_kgs" class="form-control"
                                            required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Save Rate</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Set Rate section -->
                <!-- ============================================================== -->

                <!-- Set Rate section -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $messages = get_messages();
                                foreach ($messages as $message) {
                                    echo '<div class="alert alert-' . $message['type'] . '">' . $message['message'] . '</div>';
                                }
                                ?>

                                <h4 class="card-title">Set Rate</h4>
                                <!-- Rest of the code -->

                                <div class="mt-4">
                                    <h4 class="card-title">Latest Fertilizer Rate</h4>
                                    <h6>
                                        <strong>Rate per 100kgs:</strong>
                                        <?php echo $latestRate['rate_per_kgs']; ?> bags
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Set Rate section -->
                <!-- ============================================================== -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fertilizer Applications</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Grower No</th>
                                                <th>Amount</th>
                                                <th>Delivered</th>
                                                <th>Created At</th>
                                                <th>Date Delivered</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($applications as $application): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $application['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $application['grower_no']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $application['amount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $application['delivered']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $application['created_at']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $application['date_delivered']; ?>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#approveModal-<?php echo $application['id']; ?>">Approve</button>
                                                    </td>
                                                </tr>

                                                <!-- Modal for approval -->
                                                <!-- Modal for approval -->
                                                <div class="modal fade" id="approveModal-<?php echo $application['id']; ?>"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="approveModalLabel-<?php echo $application['id']; ?>"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="approveModalLabel-<?php echo $application['id']; ?>">
                                                                    Approve Fertilizer Application</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="approveForm-<?php echo $application['id']; ?>">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $application['id']; ?>">
                                                                    <input type="hidden" name="date_delivered"
                                                                        value="<?php echo date('Y-m-d'); ?>">
                                                                    <p>ID:
                                                                        <?php echo $application['id']; ?>
                                                                    </p>
                                                                    <p>Grower No:
                                                                        <?php echo $application['grower_no']; ?>
                                                                    </p>
                                                                    <p>Amount:
                                                                        <?php echo $application['amount']; ?>
                                                                    </p>
                                                                    <p>Delivered:
                                                                        <?php echo $application['delivered']; ?>
                                                                    </p>
                                                                    <p>Created At:
                                                                        <?php echo $application['created_at']; ?>
                                                                    </p>
                                                                    <p>Date Delivered:
                                                                        <?php echo $application['date_delivered']; ?>
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="approveFertilizerApplication(<?php echo $application['id']; ?>)">Approve</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Fertilizer Applications table -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include "footer.php"; ?>
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
        function approveFertilizerApplication(applicationId) {
            var formData = new FormData(document.getElementById('approveForm-' + applicationId));
            $.ajax({
                url: 'approve_fertilizer.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response); // Debugging statement
                    // Handle the response from the PHP script
                    if (response) {
                        // Update the table row or perform any other necessary actions
                        // For example, you can change the status column value to "Approved"
                        $('#status-' + applicationId).text('Approved');
                        alert('Submitted.');
                        // Refresh the current page
                        location.reload();

                    }
                    // Close the modal
                    $('#approveModal-' + applicationId).modal('hide');
                },
                error: function () {
                    // Handle the error scenario
                    alert('An error occurred while processing the request. Please try again.');
                    // Close the modal
                    $('#approveModal-' + applicationId).modal('hide');
                }
            });
        }
    </script>

</body>

</html>