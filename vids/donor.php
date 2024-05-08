<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "bloodbank"; // Your MySQL database name


// Create connection
$conn = new mysqli($servername . ':' . $port, $username, $password, $database);

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
    $diseases = isset($_POST["diseases"]) ? $_POST["diseases"] : [];
    $medicationHistory = isset($_POST["medicationHistory"]) ? $_POST["medicationHistory"] : "";
    $surgeryTransfusion = isset($_POST["surgeryTransfusion"]) ? $_POST["surgeryTransfusion"] : "";

    // Process the data further, you can save it to a database or perform any other actions

    // For demonstration purposes, let's just print the received data
    echo "<h2>Submitted Data:</h2>";
    echo "<p>Blood Type: $bloodType</p>";
    echo "<p>Weight: $weight kg</p>";
    echo "<p>Number of Blood Units: $bloodUnits</p>";
    echo "<p>First Time Donor: $firstTimeDonor</p>";
    if ($firstTimeDonor == "No" && !empty($lastDonationDate)) {
        echo "<p>Last Donation Date: $lastDonationDate</p>";
    }
    if (!empty($diseases)) {
        echo "<p>Medical History:</p>";
        echo "<ul>";
        foreach ($diseases as $disease) {
            echo "<li>$disease</li>";
        }
        echo "</ul>";
    }
    if (!empty($medicationHistory)) {
        echo "<p>Medication History: $medicationHistory</p>";
    }
    if (!empty($surgeryTransfusion)) {
        echo "<p>Surgery/Transfusion History: $surgeryTransfusion</p>";
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: index.html");
    exit;
}
?>