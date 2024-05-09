
<?php

$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "bloodbank"; // Your MySQL database name
$port = 3306; // Default MySQL port

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
    <title>Donor List</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="main">
    <style>
        .navbar-brand {
            font-size: 30px; /* Adjust the font size as needed */
        }
   
        .navbar.bg-dark {
            background-color: #9b1422 !important;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="logo" width="50" height="50">
            BloodOasis
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="admin.html">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="req.html">Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donorlist.html">Donor List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <H1>DASHBOARD</H1>
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
                        <h3>Blood Group &nbsp; &nbsp; O</h3>
                        <p class="units">Units: <span id="bloodO"><?php echo $bloodO; ?></span></p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="blood-group">
                        <h3>Blood Group  O-</h3>
                        <p class="units">Units: <span id="bloodONeg"><?php echo $bloodONeg; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="dashboard.js"></script>



</body>
</html>
