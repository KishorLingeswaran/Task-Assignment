<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SaleDate, COUNT(productId) AS product_count FROM sales GROUP BY SaleDate";
$result = $conn->query($sql);

$saleDates1 = [];
$productCounts1 = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $saleDates1[] = $row["SaleDate"];
        $productCounts1[] = (int)$row["product_count"];
    }
}

$sql2 = "SELECT SaleDate, COUNT(*) AS count FROM sales GROUP BY SaleDate";
$result2 = $conn->query($sql2);

$saleDates2 = [];
$productCounts2 = [];

if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $saleDates2[] = $row["SaleDate"];
        $productCounts2[] = (int)$row["count"];
    }
}

$conn->close();

$data1 = [
    'labels' => $saleDates1,
    'data' => $productCounts1
];

$data2 = [
    'labels' => $saleDates2,
    'data' => $productCounts2
];

$jsonData1 = json_encode($data1);
$jsonData2 = json_encode($data2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .main-content {
            margin-left: 300px; 
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .chart-container {
            width: 80%;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<?php include 'side_menu.php'; ?>

<div class="main-content">
    <div class="chart-container">
        <canvas id="salesChart1"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="salesChart2"></canvas>
    </div>
</div>

<script>
var jsonData1 = <?php echo $jsonData1; ?>;
var jsonData2 = <?php echo $jsonData2; ?>;

const labels1 = jsonData1.labels;
const counts1 = jsonData1.data;

const labels2 = jsonData2.labels;
const counts2 = jsonData2.data;

var ctx1 = document.getElementById('salesChart1').getContext('2d');
var salesChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: labels1,
        datasets: [{
            label: 'Number of Products Sold',
            data: counts1,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

var ctx2 = document.getElementById('salesChart2').getContext('2d');
var salesChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: labels2,
        datasets: [{
            label: 'Number of Products Sold',
            data: counts2,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
