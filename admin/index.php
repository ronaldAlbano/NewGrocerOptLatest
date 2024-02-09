<?php include('includes/header.php'); 

$dataPoints = fetchTotalSalesData($conn);
$piePoints = fetchProductDistribution($conn);?>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    window.onload = function () {
        // Render Total Sales per Day chart
        var salesChart = new CanvasJS.Chart("salesChartContainer", {
            animationEnabled: true,
            theme: "light2",

            axisX: {
                valueFormatString: "DD MMM"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "splineArea",
                color: "#6599FF",
                xValueType: "dateTime",
                xValueFormatString: "DD MMM",
                yValueFormatString: "#,##0.00",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        salesChart.render();

        // Render Product Distribution by Category chart
        var pieChart = new CanvasJS.Chart("pieChartContainer", {
            animationEnabled: true,

            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y}%)",
                dataPoints: <?php echo json_encode($piePoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        pieChart.render();
    }
</script>


<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-list-alt fa-3x me-3"></i> <!-- Icon -->
                    <span>Total Category</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="fw-bold mb-0 ms-3"><?= getCount('categories'); ?> </h1> <!-- Added ms-3 for margin-left -->
                    <a class="small text-white stretched-link" href="categories.php"><span class="d-inline-block">View Details &nbsp;&nbsp;<i class="fas fa-angle-right fa-lg"></i></span></a> <!-- Wrapped text and arrow in a span -->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-cube fa-3x me-3"></i> <!-- Icon -->
                    <span>Total Products</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="fw-bold mb-0 ms-3"><?= getCount('products'); ?> </h1> <!-- Added ms-3 for margin-left -->
                    <a class="small text-white stretched-link" href="products.php"><span class="d-inline-block">View Details &nbsp;&nbsp;<i class="fas fa-angle-right fa-lg"></i></span></a> <!-- Wrapped text and arrow in a span -->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-3x me-3"></i> <!-- Icon -->
                    <span>Total Orders</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="fw-bold mb-0 ms-3"><?= getCount('orders'); ?> </h1> <!-- Added ms-3 for margin-left -->
                    <a class="small text-white stretched-link" href="orders.php"><span class="d-inline-block">View Details &nbsp;&nbsp;<i class="fas fa-angle-right fa-lg"></i></span></a> <!-- Wrapped text and arrow in a span -->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user fa-3x me-3"></i> <!-- Icon -->
                    <span>Total Staff</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="fw-bold mb-0 ms-3"><?= getCount('admins'); ?> </h1> <!-- Added ms-3 for margin-left -->
                    <a class="small text-white stretched-link" href="admins.php"><span class="d-inline-block">View Details &nbsp;&nbsp;<i class="fas fa-angle-right fa-lg"></i></span></a> <!-- Wrapped text and arrow in a span -->
                </div>
            </div>
        </div>
    </div>


      <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Total Sales per Day
                </div>
            <div class="card-body">
                <div id="chartWrapper" style="margin: 0px;">
                    <div id="salesChartContainer" style="height: 295px; width: 100%;"></div> <!-- Adjusted height -->
                </div>
            </div>
         </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Orders per Month
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="38.98"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Product Distribution by Category
                </div>
                <div id="pieChartContainer" style="height: 370px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>