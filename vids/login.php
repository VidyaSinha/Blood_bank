<?php
require_once 'dbconn.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            
            $cookie_name = "user_id";
            $cookie_value = $row['user_id'];
            setcookie($cookie_name, $cookie_value, time() + (86400), "/");
            echo "Login successful";
            
             header("Location: index.html");
             exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
