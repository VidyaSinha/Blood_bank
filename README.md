# BloodOasis - Blood Bank Management System

BloodOasis is a web-based blood bank management system that facilitates blood donation and request management. The system connects blood donors with those in need of blood transfusions.

## Features

### User Management
- User registration and login system
- Separate interfaces for users and administrators
- Secure logout functionality

### For Blood Recipients
- Submit blood requests
- Track request status (Accepted/Rejected)
- View request statistics
- Search for available blood donors

### For Blood Donors
- Register as a blood donor
- Update donation availability
- View donation history
- Manage donor profile

### Administrative Features
- Dashboard to monitor all blood requests
- Accept or reject blood donation requests
- Manage donor database
- View system statistics

## Technology Stack

- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP
- Database: MySQL
- Server: XAMPP (Apache)

## Installation

1. Install XAMPP on your system
2. Clone this repository to `c:\xampp\htdocs\Blood_bank`
3. Start Apache and MySQL services in XAMPP
4. Import the `bloodbank.sql` file into your MySQL database
5. Configure the database connection in PHP files (default configuration):
   - Server: localhost:3308
   - Username: root
   - Password: (empty)
   - Database: bloodbank

## Pages Description

- `index.html` - Landing page
- `login.html` - User authentication
- `signup.html` - New user registration
- `user.php` - User dashboard
- `admin.php` - Administrator dashboard
- `donor.html` - Donor registration
- `LFB.html` - Blood request form
- `about.html` - Information about BloodOasis

## Usage

1. Access the application through a web browser
2. Register as a new user or login with existing credentials
3. Navigate through the interface based on your role (donor/recipient/admin)
4. Submit or manage blood requests
5. Track request status and view statistics

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For support, please open an issue in the repository or contact the system administrators.

View the design and layout on live link : https://vidyasinha.github.io/Blood_bank
