<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
    <link rel="stylesheet" href="req.css">
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
    <ul>
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
        $sql = "SELECT * FROM blood_request";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row["blood_type"];
                echo "<div class='action-buttons'>";
                echo "<button class='accept-button' onclick='acceptRequest(" . $row["id"] . ")'>Accept</button>";
                echo "<button class='reject-button' onclick='rejectRequest(" . $row["id"] . ")'>Reject</button>";
                echo "</div></li>";
            }
        } else {
            echo "No requests found";
        }

        // Close connection
        $conn->close();
        ?>
    </ul>
</body>
<script>
    function acceptRequest(requestId) {
        // Send an AJAX request to accept the request
        alert("Request with ID " + requestId + " accepted!");
    }

    function rejectRequest(requestId) {
        // Send an AJAX request to reject the request
        alert("Request with ID " + requestId + " rejected!");
    }
</script>
</html>
