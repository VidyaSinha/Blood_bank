$(document).ready(function(){
    // Initialize Image Slider
    $('.slider').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true
    });

    // Client-side validation for registration form
    $('#registrationForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        // Your validation logic here
        // If validation fails, show error messages and return false
        // If validation passes, submit the form
        this.submit();
    });

    // Client-side validation for login form
    $('#loginForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        // Your validation logic here
        // If validation fails, show error messages and return false
        // If validation passes, submit the form
        this.submit();
    });
});
