
<?php

$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "bloodbank"; // Your MySQL database name
$port = 3308; // Default MySQL port

// Create connection
$conn = new mysqli($servername . ':' . $port, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store blood units
$bloodA = 0;
$bloodANeg = 0;
$bloodB = 0;
$bloodBNeg = 0;
$bloodAB = 0;
$bloodABNeg = 0;
$bloodO = 0;
$bloodONeg = 0;

// Query to fetch blood units from the donor table
$sql = "SELECT blood_type, SUM(bloodUnits) AS totalUnits FROM donor GROUP BY blood_type";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Update the respective blood group's units
        switch ($row["blood_type"]) {
            case "A+":
                $bloodA = $row["totalUnits"];
                break;
            case "A-":
                $bloodANeg = $row["totalUnits"];
                break;
            case "B+":
                $bloodB = $row["totalUnits"];
                break;
            case "B-":
                $bloodBNeg = $row["totalUnits"];
                break;
            case "AB+":
                $bloodAB = $row["totalUnits"];
                break;
            case "AB-":
                $bloodABNeg = $row["totalUnits"];
                break;
            case "O+":
                $bloodO = $row["totalUnits"];
                break;
            case "O-":
                $bloodONeg = $row["totalUnits"];
                break;
            default:
                break;
        }
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<style>
    body {
        
        font-family: "Barlow", sans-serif;
  font-weight: 100;

        background-color: #f4f4f4;
        font-size: 1.2rem;
        padding-top: 10px; /* Adjusted to accommodate fixed navbar */
    }
 

    @media screen and (min-width: 992px) {
        .navbar .container-fluid,
        .navbar-expand-lg .navbar-collapse,
        .navbar-expand-lg .navbar-nav {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar {
            width: 18%;
            height: 100vh;
            align-items: flex-start;
        }

        .navbar-brand {
            margin-left: 0.5rem;
        }

        .main {
            margin-left: 20%;
            padding: 20px; /* Added padding */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px; /* Added margin for spacing */
        }
    }

    .navbar .navbar-nav .nav-link {
        color: #fff;
        font-size: 1em;
    }

    .navbar-brand {
        font-size: 1.2em;
        font-weight: bold;
    }

    .blood-groups h2,
    .chart-container h2 {
        font-size: 1.2rem;
        margin-bottom: 10px; /* Added margin for spacing */
    }

    .blood-group h3 {
        font-size: 1rem;
        margin-bottom: 5px; /* Added margin for spacing */
    }

    .blood-group .units {
        font-size: 0.9rem;
    }

    .chart-container {
        width: 45%;
        margin-left:20px; /* Adjusted width */
        padding: 10px; /* Added padding */
        background-color: #fff;
        /* Added background color */
        border: 1px solid #ccc; /* Added border */
        border-radius: 5px; /* Added border radius */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Added box shadow */
    }

    
    .blood-units,
    .chart-container {
        display: inline-block;
        vertical-align: top;
        margin-bottom: 20px; /* Added margin for spacing */
    }
</style>

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #39A6A3;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="logo.png" alt="logo" width="50" height="50">
                BloodOasis
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="req.php">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donorlist.php">Donor List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main">
        <h1 class="mt-4">DASHBOARD</h1>
        <div class="container">
            <div class="blood-units">
                <div class="blood-groups">
                    <h2>Blood Units Available</h2>
                    <div class="row">
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group A</h3>
                                <p class="units">Units: <span id="bloodA"><?php echo $bloodA; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group A-</h3>
                                <p class="units">Units: <span id="bloodANeg"><?php echo $bloodANeg; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group B</h3>
                                <p class="units">Units: <span id="bloodB"><?php echo $bloodB; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group B-</h3>
                                <p class="units">Units: <span id="bloodBNeg"><?php echo $bloodBNeg; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group AB</h3>
                                <p class="units">Units: <span id="bloodAB"><?php echo $bloodAB; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group AB-</h3>
                                <p class="units">Units: <span id="bloodABNeg"><?php echo $bloodABNeg; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group O</h3>
                                <p class="units">Units: <span id="bloodO"><?php echo $bloodO; ?></span></p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="blood-group">
                                <h3>Blood Group O-</h3>
                                <p class="units">Units: <span id="bloodONeg"><?php echo $bloodONeg; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-container">
                <h2>Blood Units Distribution</h2>
                <canvas id="bloodChart"></canvas>
            </div>
        </div>

        <div class="line-chart-summary">
            <h2>Weekly Donations Summary</h2>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sample data for weekly donations
        var weeklyData = {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
            datasets: [{
                label: 'Blood Donations',
                data: [10, 15, 8, 12, 18], // Replace with your actual weekly donation data
                borderColor: 'rgba(242, 140, 140, 1)',
                backgroundColor: 'rgba(242, 140, 140, 0.2)', 

                borderWidth: 2, 
                fill: true
            }]
        };

        // Configuration options for the chart
        var config = {
            type: 'line',
            data: weeklyData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Weekly Donations',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Week'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Units Donated'
                        }
                    }
                }
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('lineChart').getContext('2d');

        // Initialize the chart
        var lineChart = new Chart(ctx, config);
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('bloodChart').getContext('2d');
            var bloodChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
                    datasets: [{
                        label: 'Blood Units',
                        data: [
                            <?php echo $bloodA; ?>,
                            <?php echo $bloodANeg; ?>,
                            <?php echo $bloodB; ?>,
                            <?php echo $bloodBNeg; ?>,
                            <?php echo $bloodAB; ?>,
                            <?php echo $bloodABNeg; ?>,
                            <?php echo $bloodO; ?>,
                            <?php echo $bloodONeg; ?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Blood Units Distribution'
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>


