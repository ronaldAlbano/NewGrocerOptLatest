<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +1);

?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link <?= $page == 'index.php' ? 'active':''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= $page == 'order-create.php' ? 'active':''; ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Create Order
                </a>

                <a class="nav-link <?= $page == 'orders.php' ? 'active':''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Product Mangement</div>

                <a class="nav-link <?= $page == 'categories.php' ? 'active':''; ?>" href="categories.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                </a>

                <a class="nav-link <?= $page == 'products.php' ? 'active':''; ?>" href="products.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                </a>

                <div class="sb-sidenav-menu-heading">Mange Users</div>

                <a class="nav-link <?= $page == 'admins.php' ? 'active':''; ?>" href="admins.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Admins
                </a>
              
            </div>
        </div>

    </nav>
</div>