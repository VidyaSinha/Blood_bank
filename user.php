<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank"; // Replace 'your_database_name' with your actual database name
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count the number of requests with different statuses
$sqlAccepted = "SELECT COUNT(*) AS acceptedCount FROM blood_requests WHERE status = 'accepted'";
$sqlRejected = "SELECT COUNT(*) AS rejectedCount FROM  blood_requests WHERE status = 'rejected'";
$sqlTotal = "SELECT COUNT(*) AS totalCount FROM blood_requests";

$resultAccepted = $conn->query($sqlAccepted);
$resultRejected = $conn->query($sqlRejected);
$resultTotal = $conn->query($sqlTotal);

$acceptedCount = $resultAccepted->fetch_assoc()['acceptedCount'];
$rejectedCount = $resultRejected->fetch_assoc()['rejectedCount'];
$totalCount = $resultTotal->fetch_assoc()['totalCount'];

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
    <link rel="stylesheet" href="user.css">
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
        <a class="navbar-brand" href="index.">
           
            <img src="logo.png" alt="logo" width="50" height="50">
            BloodOasis
        </a>
        <span class="navbar-user">Hello, User <span id="loggedInUser"></span></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="LFB.html">Looking for blood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donor.html">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <body>
        <span id="greetingMessage"></span>
    <div id="requestStats">
        <p>Accepted Requests: <?php echo $acceptedCount; ?></p>
        <p>Rejected Requests: <?php echo $rejectedCount; ?></p>
        <p>Total Requests: <?php echo $totalCount; ?></p>
    </div>
    <button id="addRequestBtn">Add Blood Request</button>
    <div id="bloodRequests"></div>
    <div id="donationDetails"></div>
    <!-- <script src="user.js"></script> -->

 
</body>

</html>
