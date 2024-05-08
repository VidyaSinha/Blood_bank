<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "bloodbank"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST["name"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $bloodType = htmlspecialchars($_POST["bloodType"]);
    $units = htmlspecialchars($_POST["units"]);
    $age = htmlspecialchars($_POST["age"]);
    $address = htmlspecialchars($_POST["address"]);
    $contactNumber = htmlspecialchars($_POST["contactNumber"]);
    $email = htmlspecialchars($_POST["email"]);

    // Validate form data (you can add more validation as needed)
    if (empty($name) || empty($gender) || empty($bloodType) || empty($units) || empty($age) || empty($address) || empty($contactNumber) || empty($email)) {
        // If any required field is empty, display an error message
        echo "All fields are required.";
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO users (name, gender, blood_type, units, age, address, contact_number, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiisss", $name, $gender, $bloodType, $units, $age, $address, $contactNumber, $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Your blood request has been submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt->close();
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: brf.html");
    exit;
}

// Close connection
$conn->close();
?>
