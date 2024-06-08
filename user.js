document.addEventListener('DOMContentLoaded', function() {
    const totalRequests = [
        { name: 'John Doe', bloodType: 'A+', status: 'Pending' },
        { name: 'Jane Smith', bloodType: 'O-', status: 'Accepted' }
    ];

    const acceptedRequests = totalRequests.filter(request => request.status === 'Accepted');

    document.getElementById('totalRequests').innerText = totalRequests.length;
    document.getElementById('acceptedRequests').innerText = acceptedRequests.length;

    const totalRequestDetails = document.getElementById('totalRequestDetails');
    totalRequests.forEach(request => {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `<span>${request.name} (${request.bloodType})</span><span>${request.status}</span>`;
        totalRequestDetails.appendChild(item);
    });

    const acceptedRequestDetails = document.getElementById('acceptedRequestDetails');
    acceptedRequests.forEach(request => {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `<span>${request.name} (${request.bloodType})</span>`;
        acceptedRequestDetails.appendChild(item);
    });
});
