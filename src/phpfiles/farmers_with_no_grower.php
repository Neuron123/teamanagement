<?php
session_start();
include "messages.php";
?>

<?php
include "header.php";
?>

<?php
include "conn.php";

// Fetch all users from the authentication table
$query = "SELECT * FROM authentication WHERE userrole='farmer' AND (grower_no IS NULL OR grower_no = '')";;
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Initialize an empty array to store the users
    $users = array();

    // Fetch each row and add it to the users array
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Query execution failed
    $users = array(); // Set an empty array if no users found or an error occurred
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
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Users</h3>
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
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addRecordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addRecordModalLabel">Edit user details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="users_process.php">
                                                    <input type="hidden" name="userId" value="" />
                                                    <div class="mb-3">
                                                        <label class="form-label">Firstname</label>
                                                        <input type="text" name="firstname" class="form-control"
                                                            value="" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Lastname</label>
                                                        <input type="text" name="lastname" class="form-control" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input type="number" name="phone" class="form-control" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" name="email" class="form-control" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Role</label>
                                                        <select name="role" class="form-control">
                                                            <option value="farmer">Farmer</option>
                                                            <option value="clerk">Clerk</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Grower No</label>
                                                        <div class="input-group">
                                                            <input type="text" name="growerno" class="form-control"
                                                                readonly />
                                                            <button id="generateGrowerNoBtn" type="button"
                                                                class="btn btn-primary">
                                                                <i class="fa fa-cog"></i>
                                                            </button>
                                                        </div>
                                                        <small>Generate Grower No</small>
                                                    </div>
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
                                <h4 class="card-title">Users</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap" id="recordtable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <!-- <th class="border-top-0">Uid</th> -->
                                                <th class="border-top-0">Firstname</th>
                                                <th class="border-top-0">Lastname</th>
                                                <th class="border-top-0">Phone</th>
                                                <th class="border-top-0">Email</th>
                                                <th class="border-top-0">Role</th>
                                                <th class="border-top-0">Reg Date</th>
                                                <th class="border-top-0">Grower No</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                            foreach ($users as $user) {
                                                echo "<tr>";
                                                echo "<td>{$index}</td>";
                                                // echo "<td>{$user['id']}</td>";
                                                echo "<td>{$user['firstname']}</td>";
                                                echo "<td>{$user['lastname']}</td>";
                                                echo "<td>{$user['phone']}</td>";
                                                echo "<td>{$user['email']}</td>";
                                                echo "<td>{$user['userrole']}</td>";
                                                echo "<td>{$user['created_at']}</td>";
                                                echo "<td>{$user['grower_no']}</td>";
                                                echo "<td><a href='#' class='recordeditid' data-user='" . json_encode($user) . "'><i class='fa fa-pencil-alt' data-bs-toggle='modal' data-bs-target='#addRecordModal'></i></a></td>";
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

    </script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();

            // Event listener for clicking on the action icon
            $('.recordeditid').on('click', function () {
                var userData = $(this).data('user');
                populateFormFields(userData);
            });

            // Function to populate the form fields with user data
            function populateFormFields(userData) {
                // Access the modal form fields
                var idField = $('#addRecordModal').find('input[name="userId"]');
                var firstnameField = $('#addRecordModal').find('input[name="firstname"]');
                var lastnameField = $('#addRecordModal').find('input[name="lastname"]');
                var phoneField = $('#addRecordModal').find('input[name="phone"]');
                var emailField = $('#addRecordModal').find('input[name="email"]');
                var roleField = $('#addRecordModal').find('select[name="role"]');
                var growerNoField = $('#addRecordModal').find('input[name="growerno"]');
                var generateGrowerNoBtn = $('#generateGrowerNoBtn');

                // Populate the form fields with user data
                idField.val(userData.id);
                firstnameField.val(userData.firstname);
                lastnameField.val(userData.lastname);
                phoneField.val(userData.phone);
                emailField.val(userData.email);
                roleField.val(userData.userrole);
                growerNoField.val(userData.grower_no || '');

                // Generate grower number on button click
                generateGrowerNoBtn.on('click', function () {
                    // Disable the button and show the gear icon
                    generateGrowerNoBtn.attr('disabled', true);
                    generateGrowerNoBtn.html('<i class="fa fa-cog fa-spin"></i> Generating...');

                    // Delay the generation for 10 seconds
                    setTimeout(function () {
                        var generatedGrowerNo = generateGrowerNo();

                        // Update the grower number field and label
                        growerNoField.val(generatedGrowerNo);
                        generateGrowerNoBtn.html('Grower No Generated');
                    }, 10000);
                });

                // Function to generate a random grower number
                function generateGrowerNo() {
                    // Generate a random number between 100 and 999
                    var randomNo = Math.floor(Math.random() * (999 - 100 + 1) + 100);
                    return randomNo;
                }
            }
        });
    </script>

</body>

</html>