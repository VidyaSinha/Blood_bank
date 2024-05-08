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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullname = $_POST['fullName'];
    $mobile_no = $_POST['contactnumber']; // Corrected name attribute
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $bloodGroup = $_POST['bloodGroup'];
    
    $sql_check = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ss", $username, $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        echo "User with this username or email already exists.";
    } else {
        $sql_insert = "INSERT INTO users (full_name, contact_number, email, username, password, dob, address, gender, blood_group) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        
        mysqli_stmt_bind_param($stmt_insert, "sssssssss", $fullname, $mobile_no, $email, $username, $hashed_password, $dob, $address, $gender, $bloodGroup);
        $result_insert = mysqli_stmt_execute($stmt_insert);
        
        if ($result_insert) {
            echo "New record created successfully";
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt_insert);
    }
    
    mysqli_stmt_close($stmt_check);

    mysqli_close($conn);
}
?>
