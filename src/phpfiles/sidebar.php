<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                        aria-expanded="false"><i class="me-3 far fa-clock fa-fw" aria-hidden="true"></i><span
                            class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="
                    <?php
                    if ($_SESSION['userrole'] == 'clerk') {
                        echo 'dashboard_clerk.php';
                    } elseif ($_SESSION['userrole'] == 'farmer') {
                        echo 'dashboard_farmer.php';
                    } elseif ($_SESSION['userrole'] == 'admin') {
                        echo 'dashboard_admin.php';
                    } else {
                        echo '#';
                    }
                    ?>
                    " aria-expanded="false">
                        <i class="me-3 fa fa-home" aria-hidden="true"></i><span class="hide-menu">Dashboard</span>
                    </a>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="pages-profile.php" aria-expanded="false">
                        <i class="me-3 fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                </li>


                <li class="sidebar-item">
                    <?php
                    if ($_SESSION['userrole'] == 'clerk') {
                        echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="tablerecords_clerk.php" aria-expanded="false">';
                    } elseif ($_SESSION['userrole'] == 'farmer') {
                        echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="tablerecords_farmer.php" aria-expanded="false">';
                    } else {
                        echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">';
                    }
                    ?>
                    <i class="me-3 fa fa-table" aria-hidden="true"></i><span class="hide-menu">
                        <?php
                        if ($_SESSION['userrole'] == 'clerk') {
                            ?>
                            All Records

                            <?php
                        }
                        if ($_SESSION['userrole'] == 'farmer') {
                            ?>
                            My Records
                            <?php
                        }
                        ?>
                    </span></a>
                </li>

                <?php
                if ($_SESSION['userrole'] == 'farmer') {
                    ?>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="fertilizer.php" aria-expanded="false"><i class="me-3 fa fa-leaf"
                                aria-hidden="true"></i><span class="hide-menu">Fertilizer Application</span></a></li>
                    <?php
                }
                ?>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        aria-expanded="false" onclick="logout()"><i class="me-3 fa fa-sign-out-alt"
                            aria-hidden="true"></i><span class="hide-menu">Logout</span></a></li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<script>
    function logout() {
        // Send an AJAX request to the PHP function
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'logout.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response here, if needed
                // For example, you can redirect the user to another page
                window.location.href = '../../landingpage/index.php';
            }
        };
        xhr.send();
    }
</script>