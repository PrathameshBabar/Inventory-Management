
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://vital.vitalgroupind.com">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="img/vital-logo.png" class="img-profile rounded-circle" width="55px">
                </div>
                <div class="sidebar-brand-text mx-3">VITAL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->

            <li class="nav-item">
                <a class="nav-link" href="Production.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Production</span>
                </a>
            </li>


            <?php
            if ($access >= 20) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="raw-material-stock.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Raw Material Stock</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="p-raw.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span> Purchased Raw material</span>
                </a>
            </li>




            <li class="nav-item">
                <a class="nav-link" href="production-stock.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Final Product Stock</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="dispatch.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dispatch</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="items.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Items</span>
                </a>
            </li>


            <!--
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span> Supplier</span>
                </a>
            </li>
            !-->

            <?php
            }
            if ($access >= 30) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="employee.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Employee Management</span></a>
            </li>
            <?php
            }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
