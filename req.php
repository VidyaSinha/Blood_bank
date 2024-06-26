<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blood Requests</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet'); 
    @import url('https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet');

    body {
        
        font-family: "Barlow", sans-serif;
  font-weight: 400;

        background-color: #f4f4f4;
        font-size: 1.2rem;
        padding-top: 10px; /* Adjusted to accommodate fixed navbar */
    }
        .navbar-brand {
            font-size: 30px; /* Adjust the font size as needed */
        }
   
        .navbar.bg-dark {
            background-color: #9b1422 !important;
        }
        .navbar-brand {
    margin-left: 20px;
   
    font-family: "El Messiri", sans-serif; /* Change font style to italic, you can adjust this to any font style you desire */
}
.navbar-brand img {
    margin-right: 10px;
    border-radius: 50%; /* Change font style to italic, you can adjust this to any font style you desire */
}
@media screen and (min-width: 992px) {
        .navbar .container-fluid,
        .navbar-expand-lg .navbar-collapse,
        .navbar-expand-lg .navbar-nav {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar {
            width: 18%;
            height: 100vh;
            align-items: flex-start;
        }

        .navbar-brand {
            margin-left: 0.5rem;
        }

        .main {
            margin-left: 20%;
            padding: 20px; /* Added padding */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px; /* Added margin for spacing */
        }
    }

    .navbar .navbar-nav .nav-link {
        color: #fff;
        font-size: 1em;
    }

    .navbar-brand {
        font-size: 1.2em;
        font-weight: bold;
    }
    
    </style>
<div class="main">

<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #9b1422;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="logo.png" alt="logo" width="50" height="50">
                BloodOasis
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="req.php">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donorlist.php">Donor List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Display blood requests here -->
    <h2>Blood Requests</h2>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Blood Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish database connection
                $servername = "localhost:3308";
                $username = "root";
                $password = "";
                $database = "bloodbank";
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch blood requests from the database and display them
                $sql = "SELECT blood_requests.*, users.full_name FROM blood_requests JOIN users ON blood_requests.name = users.full_name";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["blood_type"] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-success' onclick='acceptRequest(" . $row["request_id"] . ")'>Accept</button>";
                        echo "<button class='btn btn-danger' onclick='rejectRequest(" . $row["request_id"] . ")'>Reject</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No requests found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
function acceptRequest(requestId) {
    // Send an AJAX request to accept the request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Request with ID " + requestId + " accepted!");
            location.reload(); // Refresh the page after accepting the request
        }
    };
    xhr.open("GET", "accept_request.php?request_id=" + requestId, true);
    xhr.send();
}

function rejectRequest(requestId) {
    // Send an AJAX request to reject the request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Request with ID " + requestId + " rejected!");
            location.reload(); // Refresh the page after rejecting the request
        }
    };
    xhr.open("GET", "reject_request.php?request_id=" + requestId, true);
    xhr.send();
}


</script> <!-- Link to the JavaScript file -->
</html>
