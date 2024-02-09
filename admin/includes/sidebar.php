<?php
// Check if the user is logged in and has a role
if(isset($_SESSION['loggedInUser']) && isset($_SESSION['loggedInUser']['role'])) {
    $role = $_SESSION['loggedInUser']['role'];
} else {
    // Default role if not logged in or role not set
    $role = '';
}
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                
                <?php if($role == 'Admin'): ?>
                <a class="nav-link <?= $page == 'index.php' ? 'active':''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                 <?php endif; ?>

                <a class="nav-link <?= $page == 'order-create.php' ? 'active':''; ?>" href="order-create.php" >
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Create Order
                </a>
                
      
                <a class="nav-link <?= $page == 'orders.php' ? 'active':''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>
       

                <?php if($role == 'Admin'): ?>
                <div class="sb-sidenav-menu-heading">Product Management</div>

                <a class="nav-link <?= $page == 'categories.php' ? 'active':''; ?>" href="categories.php" data-role="Admin">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                </a>

                <a class="nav-link <?= $page == 'products.php' ? 'active':''; ?>" href="products.php" data-role="Admin">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                </a>
                <?php endif; ?>

                <?php if($role == 'Admin'): ?>
                <div class="sb-sidenav-menu-heading">Manage Users</div>

                <a class="nav-link <?= $page == 'admins.php' ? 'active':''; ?>" href="admins.php" >
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Admins
                </a>
                <?php endif; ?>
              
            </div>
        </div>

    </nav>
</div>
