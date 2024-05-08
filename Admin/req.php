<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blood Requests</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the updated CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="main">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="logo" width="50" height="50">
            BloodOasis
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="admin.html">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="req.html">Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donorlist.html">Donor List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Log Out</a>
                </li>
            </ul>
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
                $servername = "localhost";
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
