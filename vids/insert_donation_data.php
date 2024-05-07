<?php
require_once 'dbconn.php';
// Function to sanitize input data to prevent SQL injection
function sanitize_data($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and process donor type data
    if (!empty($_POST['donor_type'])) {
        $donor_type = implode(", ", array_map('sanitize_data', $_POST['donor_type']));
    } else {
        $donor_type = "";
    }

    // Sanitize and process donation type data
    if (!empty($_POST['donation_type'])) {
        $donation_type = implode(", ", array_map('sanitize_data', $_POST['donation_type']));
    } else {
        $donation_type = "";
    }

    // Sanitize and process component type data
    if (!empty($_POST['component_type'])) {
        $component_type = implode(", ", array_map('sanitize_data', $_POST['component_type']));
    } else {
        $component_type = "";
    }

    // Sanitize and process bag size data
    if (!empty($_POST['bag_size'])) {
        $bag_size = implode(", ", array_map('sanitize_data', $_POST['bag_size']));
    } else {
        $bag_size = "";
    }

    // SQL to insert data into the table
    $sql = "INSERT INTO donation_data (donor_type, donation_type, component_type, bag_size) 
            VALUES ('$donor_type', '$donation_type', '$component_type', '$bag_size')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
