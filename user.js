document.addEventListener("DOMContentLoaded", function() {
    // Assuming you have a function to fetch user data from the server
    fetchUserData().then(userData => {
        // Greet the user
        document.getElementById("greetingMessage").innerText = `Hello, ${userData.username}!`;

        // Display blood request stats
        const totalRequests = userData.bloodRequests.length;
        const acceptedRequests = userData.bloodRequests.filter(request => request.status === "Accepted").length;
        const deniedRequests = userData.bloodRequests.filter(request => request.status === "Denied").length;

        document.getElementById("requestStats").innerHTML = `
            <h2>Blood Request Stats</h2>
            <table>
                <tr>
                    <td>Total Requests:</td>
                    <td>${totalRequests}</td>
                </tr>
                <tr>
                    <td>Accepted Requests:</td>
                    <td>${acceptedRequests}</td>
                </tr>
                <tr>
                    <td>Denied Requests:</td>
                    <td>${deniedRequests}</td>
                </tr>
            </table>
        `;

        // Display donation details
        let donationDetailsHTML = "<h2>Donation Details</h2>";
        if (userData.donationDetails) {
            donationDetailsHTML += `<p>Total Donations: ${userData.donationDetails.total}</p>`;
            // Add more details as needed
        } else {
            donationDetailsHTML += "<p>No donation details available.</p>";
        }
        document.getElementById("donationDetails").innerHTML = donationDetailsHTML;

        // Add event listener for adding a new blood request
        document.getElementById("addRequestBtn").addEventListener("click", function() {
            window.location.href = "LFB.html";
        });

        // Populate blood request table
        populateBloodRequestTable(userData.bloodRequests);
    }).catch(error => {
        console.error("Error fetching user data:", error);
    });
});

// Function to populate blood request table
function populateBloodRequestTable(requests) {
    let tableHTML = `
        <h2>Blood Requests</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
    `;
    requests.forEach(request => {
        tableHTML += `
            <tr>
                <td>${request.date}</td>
                <td>${request.status}</td>
            </tr>
        `;
    });
    tableHTML += "</table>";
    document.getElementById("bloodRequests").innerHTML = tableHTML;
}

// Function to fetch user data from the server
function fetchUserData() {
    // Assuming this function returns a Promise that resolves with user data
    return new Promise((resolve, reject) => {
        // Simulated user data
        const userData = {
            username: "JohnDoe",
            bloodRequests: [
                { date: "2024-05-01", status: "Accepted" },
                { date: "2024-05-05", status: "Denied" },
                { date: "2024-05-10", status: "Accepted" }
            ],
            donationDetails: {
                total: 3
                // Add more details as needed
            }
        };
        resolve(userData);
    });
}
