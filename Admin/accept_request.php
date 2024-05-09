<?php
// Establish database connection
$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "bloodbank";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the request ID from the GET parameters
$requestId = $_GET["request_id"];

// Update the status of the blood request to accepted in the database
$sql = "UPDATE blood_requests SET status = 'Accepted' WHERE request_id = $requestId";

if ($conn->query($sql) === TRUE) {
    echo "Request accepted successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close connection
$conn->close();
?>
