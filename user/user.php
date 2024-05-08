<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="main">
    <style>
        .navbar-brand {
            font-size: 30px; /* Adjust the font size as needed */
        }
   
        .navbar.bg-dark {
            background-color: #9b1422 !important;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="index.">
           
            <img src="logo.png" alt="logo" width="50" height="50">
            BloodOasis
        </a>
        <span class="navbar-user">Hello, <span id="loggedInUser"></span></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="/about.html">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vids/LFB.html">Looking for blood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vids/donor.html">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

  
    <body>
        <span id="greetingMessage"></span>
    <div id="requestStats"></div>
    <button id="addRequestBtn">Add Blood Request</button>
    <div id="bloodRequests"></div>
    <div id="donationDetails"></div>
    <script src="user.js"></script>

 
</body>

</html>