<?php
// Set the timezone to Taipei
date_default_timezone_set('Asia/Taipei');
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#">GrocerOpt</a>
    <!-- Sidebar Toggle-->
   
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto" style="margin-right: 20px;"> <!-- Apply ms-auto here for right alignment -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                <?= $_SESSION['loggedInUser']['name']; ?>
                <!-- Display current date and time dynamically -->
                <span id="datetime" class="text-light ms-2"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script>
// Function to update the current date and time every second
function updateDateTime() {
    var now = new Date();
    var dateTime = now.toLocaleString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
    document.getElementById('datetime').textContent = dateTime;
}

// Call the updateDateTime function every second
setInterval(updateDateTime, 1000);
</script>
