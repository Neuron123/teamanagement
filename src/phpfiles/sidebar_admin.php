<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard_admin.php"
                        aria-expanded="false"><i class="me-3 far fa-clock fa-fw" aria-hidden="true"></i><span
                            class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard_admin.php" aria-expanded="false">
                        <i class="me-3 fa fa-home" aria-hidden="true"></i><span class="hide-menu">Dashboard</span>
                    </a>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="pages-profile.php" aria-expanded="false">
                        <i class="me-3 fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                </li>


                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="users.php" aria-expanded="false">
                        <i class="me-3 fa fa-users" aria-hidden="true"></i><span class="hide-menu">All Users</span></a>
                </li> -->

                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="tablerecords_admin.php" aria-expanded="false">
                        <i class="me-3 fa fa-table" aria-hidden="true"></i><span class="hide-menu">Tea Records</span></a>
                </li> -->

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="fertilizer_admin.php" aria-expanded="false">
                        <i class="me-3 fa fa-leaf" aria-hidden="true"></i><span class="hide-menu">Fertilizer Applications</span></a>
                </li>

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
                window.location.href = 'login2.php';
            }
        };
        xhr.send();
    }
</script>