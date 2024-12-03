// This function is called when the form is submitted
function handleLoginSubmit(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the form data
    const email = document.getElementById("email").value; 
    const password = document.getElementById("password").value;

    // Prepare the data to send in the POST request
    const loginData = new URLSearchParams();
    loginData.append("email", email);
    loginData.append("password", password);

    // Send login data to the PHP server using Fetch API
    fetch('../backend/login.php', { // This is the PHP script that handles login
        method: 'POST',
        body: loginData, 
    })
    .then(response => response.text())
    .then(data => {
        // Check if login was successful
        if (data === "Login successful!") {
            
            // Redirect to the profile page
            window.location.href = "profile.php";
        } else {
            // If login fails, show an error message
            alert("Invalid email or password!");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("There was an error with the login. Please try again.");
    });
}
