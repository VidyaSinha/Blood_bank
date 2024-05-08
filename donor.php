<?php
$servername = "localhost:3308"; // Change this if your MySQL server is running on a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "bloodbank"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bloodType = $_POST["bloodType"];
    $weight = $_POST["weight"];
    $bloodUnits = $_POST["bloodUnits"];
    $firstTimeDonor = $_POST["firstTimeDonor"];
    $lastDonationDate = isset($_POST["lastDonationDate"]) ? $_POST["lastDonationDate"] : "";
    $diseases = isset($_POST["diseases"]) ? implode(", ", $_POST["diseases"]) : "";
    $surgeryTransfusion = isset($_POST["surgeryTransfusion"]) ? implode(", ", $_POST["surgeryTransfusion"]) : "";

    // Prepare SQL statement
    $sql = "INSERT INTO donor (blood_type, bloodUnits ,weight, first_time_donor, last_donation_date, surgery_transfusion_history) VALUES (?,?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissss", $bloodType, $bloodUnits, $weight, $firstTimeDonor, $lastDonationDate, $surgeryTransfusion);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Your blood donation information has been successfully recorded.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: index.html");
    exit;
}

// Close connection
$conn->close();
?>
