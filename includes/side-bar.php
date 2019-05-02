<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Kotem Stores</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li>
            <a href="../estock/cart.php"><i class="fa fa-shopping-cart"></i> Cart</a>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="../estock/profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="../estock/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="../estock/home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li class="active">
                    <a href="../estock/orders.php"><i class="fa fa-shopping-cart fa-fw"></i> Sales</a>
                </li>
                 <li>
                    <a href="../estock/products.php"><i class="fa fa-product-hunt fa-fw"></i> Products</a>
                </li>
                <li>
                    <a href="../estock/suppliers.php"><i class="fa fa-bank fa-fw"></i> Suppliers</a>
                </li>
                <li>
                    <a href="../estock/customers.php"><i class="fa fa-users fa-fw"></i> Customers</a>
                </li>
                <li>
                    <a href="../estock/sales-people.php"><i class="fa fa-user-secret fa-fw"></i> Sales Persons</a>
                </li>
                <?php
                if($_SESSION['user_type'] == "admin"){
                    ?>
                    <li>
                        <a href="../estock/reports.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
                    </li>
                <?php
                }
                ?>
                <li>
                    <a href="../estock/profile.php"><i class="fa fa-user fa-fw"></i> Profile</a>
                </li>
                <li>
                    <a href="../estock/logout.php"><i class="fa fa-lock fa-fw"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>