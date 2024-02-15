<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BMMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["username"]; ?></a>
                <small style="color: white;"> <?php echo $_SESSION["email"]; ?></small>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" hidden>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Functionality 1
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>F1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>F2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>F3</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Scheduling
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="busdaily.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bus Daily</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bus Servicing</p>
                            </a>
                        </li>
                        <li class="nav-item" hidden>
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>F3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            LIST
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="bus.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BUS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="garage.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>GARAGE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="make.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>MAKE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="model.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>MODEL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="spare.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SPARE PARTS</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php
                                                //If not admin
                                                if ($_SESSION['level'] != 0) {
                                                    echo 'hidden';
                                                } ?>>
                            <a href="user.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>USERS</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php
                                                //If not admin
                                                if ($_SESSION['level'] != 0) {
                                                    echo 'hidden';
                                                } ?>>
                            <a href="role.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ROLES</p>
                            </a>
                        </li>
                    </ul>
                </li>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>