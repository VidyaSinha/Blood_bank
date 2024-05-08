<?php
// Database connection parameters
<<<<<<< HEAD
$servername = "localhost:3308";
=======
$servername = "localhost";
>>>>>>> 3c3a75cf4c8c4c77535d01419c3ca217726ba1b7
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password (if any)
$database = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS bloodbank";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, "bloodbank");

// SQL statements to create tables
$sql_users = "CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(255) NOT NULL,
  contact_number VARCHAR(15) NOT NULL,
  email VARCHAR(255) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  dob DATE NOT NULL,
  address TEXT NOT NULL,
  gender ENUM('Male', 'Female', 'Other') NOT NULL,
  blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username_unique (username),
  UNIQUE KEY email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$sql_donor = "CREATE TABLE donor (
  id INT(11) NOT NULL AUTO_INCREMENT,
  blood_type VARCHAR(5) NOT NULL,
  weight DECIMAL(5,2) NOT NULL,
  first_time_donor ENUM('Yes','No') NOT NULL,
  last_donation_date DATE,
  surgery_transfusion_history TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$sql_medical_history = "CREATE TABLE medical_history (
  id INT(11) NOT NULL AUTO_INCREMENT,
  donor_id INT(11) NOT NULL,
  medical_condition VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (donor_id) REFERENCES donor (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$sql_surgery_transfusion_history = "CREATE TABLE surgery_transfusion_history (
  id INT(11) NOT NULL AUTO_INCREMENT,
  donor_id INT(11) NOT NULL,
  history TEXT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (donor_id) REFERENCES donor (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

// Execute SQL statements
if ($conn->query($sql_users) === TRUE) {
    echo "Table users created successfully<br>";
} else {
    echo "Error creating table users: " . $conn->error;
}

if ($conn->query($sql_donor) === TRUE) {
    echo "Table donor created successfully<br>";
} else {
    echo "Error creating table donor: " . $conn->error;
}

if ($conn->query($sql_medical_history) === TRUE) {
    echo "Table medical_history created successfully<br>";
} else {
    echo "Error creating table medical_history: " . $conn->error;
}

if ($conn->query($sql_surgery_transfusion_history) === TRUE) {
    echo "Table surgery_transfusion_history created successfully<br>";
} else {
    echo "Error creating table surgery_transfusion_history: " . $conn->error;
}

// Close connection
$conn->close();
?>