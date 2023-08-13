<!DOCTYPE html>
<html>
<head>
    <title>Customer Visualization</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('customer'); ?>">SKI CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('customer'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="visualisasi">Visualisasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</head>
<body>
    <div class="container mt-4">
        <h1>Customer Visualization</h1>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kab/Kota</th>
                            <th>Jumlah Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer_counts as $city => $count): ?>
                            <tr>
                                <td><?php echo $city; ?></td>
                                <td><?php echo $count; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <canvas id="barChart"></canvas>
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
$(document).ready(function() {
    // Get customer counts by city from PHP
    var customerCounts = <?php echo json_encode($customer_counts); ?>;

    // Prepare data for the chart
    var cities = Object.keys(customerCounts);
    var counts = Object.values(customerCounts);

    // Create a bar chart using Chart.js
    var ctx = document.getElementById("barChart").getContext("2d");
    var barChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: cities,
            datasets: [{
                label: "Jumlah Customer",
                data: counts,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // Get customer counts by gender from PHP
    var genderCounts = <?php echo json_encode($gender_counts); ?>;
    var genderLabels = Object.keys(genderCounts);
    var genderData = Object.values(genderCounts);

    // Create a doughnut chart using Chart.js
    var doughnutCtx = document.getElementById("doughnutChart").getContext("2d");
    var doughnutChart = new Chart(doughnutCtx, {
        type: "doughnut",
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ["rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)"],
                borderColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"],
                borderWidth: 1
            }]
        }
    });
});
</script>
</html>
