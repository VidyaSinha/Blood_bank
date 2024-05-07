<?php
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $bloodType = $_POST['bloodType'];
    $weight = $_POST['weight'];
    $lastDonationDate = $_POST['lastDonationDate'];
    // Add other form fields as needed

    // Insert data into the database
    $sql = "INSERT INTO donation_data (blood_type, weight, last_donation_date) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sds", $bloodType, $weight, $lastDonationDate);
    mysqli_stmt_execute($stmt);

    // Check if data is inserted successfully
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
}
?>
