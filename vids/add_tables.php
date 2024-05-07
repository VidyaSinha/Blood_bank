<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS bloodbank";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, "bloodbank");


$sql = "CREATE TABLE IF NOT EXISTS donors (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT(3),
    gender ENUM('Male', 'Female', 'Other'),
    bloodgroup ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
    father_name VARCHAR(255),
    mobile_no VARCHAR(15),
    email VARCHAR(255),
    state VARCHAR(255),
    district VARCHAR(255),
    address VARCHAR(255),
    pincode VARCHAR(10)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table donors created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql="CREATE TABLE IF NOT EXISTS donation_data (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    donor_type VARCHAR(255),
    donation_type VARCHAR(255),
    component_type VARCHAR(255),
    bag_size VARCHAR(255),
    donor_id INT(6) UNSIGNED,
    FOREIGN KEY (donor_id) REFERENCES donors(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table donation_data created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql="CREATE TABLE IF NOT EXISTS user (
    user_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255),
    mobile_no VARCHAR(15),
    email VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();