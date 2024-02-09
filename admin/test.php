<?php include('includes/header.php'); ?>

<?php
// Fetch count of products per category from the database
$query = "SELECT c.name AS category_name, COUNT(p.id) AS product_count 
          FROM categories c 
          LEFT JOIN products p ON c.id = p.category_id 
          GROUP BY c.id";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

$dataPoints = array();
$totalCount = 0;

// Calculate total count of all products
while ($row = mysqli_fetch_assoc($result)) {
    $totalCount += $row['product_count'];
}

// Convert query result to data points format with percentage
mysqli_data_seek($result, 0); // Reset result pointer
while ($row = mysqli_fetch_assoc($result)) {
    $percentage = ($row['product_count'] / $totalCount) * 100;
    $dataPoints[] = array("label" => $row['category_name'], "y" => $percentage);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Product Distribution by Category"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y}%)",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>
</html>

<?php include('includes/footer.php'); ?>
