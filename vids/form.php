<?php
require_once 'dbconn.php';


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $father_name = $_POST['father_name'];
    $mobile_no = $_POST['mobile_no'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $sql_check = "SELECT * FROM donors WHERE email = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "User with this email already exists.";
    } else {
       
        $sql_insert = "INSERT INTO donors (name, age, gender, father_name, mobile_no, email, state, district, address, pincode)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "sissssssss", $name, $age, $gender, $father_name, $mobile_no, $email, $state, $district, $address, $pincode);

        if (mysqli_stmt_execute($stmt_insert)) {
            echo "New record created successfully";
            
            $inserted_id = mysqli_insert_id($conn);
            $_SESSION['donor_id'] = $inserted_id;

            header("Location: donate.html");
            exit(); 
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }

    // Close prepared statements
    mysqli_stmt_close($stmt_check);
    mysqli_stmt_close($stmt_insert);
}
?>
