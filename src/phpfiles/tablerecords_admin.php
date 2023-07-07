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
$sql = "SELECT grower_no FROM authentication WHERE userrole = 'farmer'";

// // Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch all rows as an associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Extract the 'grower_no' values into a separate array
    $growerNos = array_column($rows, 'grower_no');

    //     // Pass the grower_no values to the template
    $data['growerNos'] = $growerNos;
} else {
    // Show error message
    echo "Error: " . $conn->error;
}


// Query to retrieve records from tea_measurements table with user details
$sql2 = "SELECT tm.*, a.firstname, a.lastname
         FROM tea_measurements tm
         INNER JOIN authentication a ON tm.grower_no = a.grower_no";

// Execute the query to retrieve tea_measurements records with user details
$result2 = $conn->query($sql2);

// Check if the query was successful
if ($result2) {
    // Fetch all rows as an associative array
    $teaMeasurements = $result2->fetch_all(MYSQLI_ASSOC);

    // Pass the tea_measurements records to the template
    $data['teaMeasurements'] = $teaMeasurements;
} else {
    // Show error message
    //echo "Error: " . $conn->error;
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
        include "sidebar_admin.php";
        ?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Tea Records</h3>

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

                                <!-- <button class="btn btn-success" id="addrecordbtn"
                                    style="position:absolute;right:25px;color:white;z-index:1000;"
                                    data-bs-toggle="modal" data-bs-target="#addRecordModal">
                                    <i class="fas fa-plus"></i> Add Record
                                </button> -->

                                <!-- Modal -->
                                <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addRecordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addRecordModalLabel">Add Record</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="tablerecords_process.php">
                                                    <div class="mb-3">
                                                        <label for="inputName" class="form-label">Grower No</label>
                                                        <select class="form-control" name="grower_no">

                                                            <?php foreach ($growerNos as $growerNo) { ?>
                                                                <option value="<?php echo $growerNo; ?>"><?php echo $growerNo; ?></option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputkgs" class="form-label">Quantity(Kgs)</label>
                                                        <input type="number" name="quantity" class="form-control"
                                                            id="inputkgs" placeholder="Enter kgs" min="1">
                                                    </div>
                                                    <!-- Add more form fields as needed -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editRecordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRecordModalLabel">Edit Record</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="tablerecords_edit.php">
                                                    
                                                    <div class="mb-3">
                                                        <label for="editGrowerNo" class="form-label">Grower No</label>
                                                        <select class="form-control" name="grower_no" id="editGrowerNo">
                                                            <?php foreach ($growerNos as $growerNo) { ?>
                                                                <option value="<?php echo $growerNo; ?>"><?php echo $growerNo; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editQuantity" class="form-label">Quantity(Kgs)</label>
                                                        <input type="number" name="quantity" class="form-control" id="editQuantity" placeholder="Enter kgs" min="1" required>
                                                    </div>
                                                    <!-- Add more form fields as needed -->
                                                    <input type="hidden" name="record_id" id="editRecordId" value="">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="card-title">Tea Records</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap" id="recordtable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">Grower No</th>
                                                <th class="border-top-0">First Name</th>
                                                <th class="border-top-0">Last Name</th>
                                                <th class="border-top-0">Quantity</th>
                                                <th class="border-top-0">Date Added</th>
                                                <th class="border-top-0">Actions</th> <!-- Added Actions column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['teaMeasurements'] as $index => $record) { ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo $record['grower_no']; ?></td>
                                                    <td><?php echo $record['firstname']; ?></td>
                                                    <td><?php echo $record['lastname']; ?></td>
                                                    <td><?php echo $record['quantity']; ?></td>
                                                    <td><?php echo $record['created_at']; ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm edit-record-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editRecordModal"
                                                            data-record-id="<?php echo $record['id']; ?>"
                                                            data-grower-no="<?php echo $record['grower_no']; ?>"
                                                            data-quantity="<?php echo $record['quantity']; ?>">
                                                            Edit
                                                        </button>
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
            </div>
        </div>

        <?php
        include "footer.php";
        ?>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
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
        // Get the Edit Record Modal
        var editRecordModal = document.getElementById('editRecordModal');

        // Add event listener to all Edit buttons
        var editButtons = document.getElementsByClassName('edit-record-btn');
        Array.from(editButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                // Retrieve the data attributes from the button
                var recordId = button.getAttribute('data-record-id');
                var growerNo = button.getAttribute('data-grower-no');
                var quantity = button.getAttribute('data-quantity');

                // Set the input values in the modal
                document.getElementById('editRecordId').value = recordId;
                document.getElementById('editGrowerNo').value = growerNo;
                document.getElementById('editQuantity').value = quantity;
            });
        });
    </script>

</body>

</html>
