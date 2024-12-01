// This function is called when the form is submitted
function handleRegisterSubmit(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the form data using FormData constructor to capture all form fields
    const formData = new FormData(document.getElementById("registerForm"));

    // Collect the standard form fields
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const maxHours = document.getElementById("maxHours").value;

    // Initialize an array to collect parent values
    const parents = [];

    // Collect parent data from dynamic fields
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('parent')) {
            parents.push(value);
        }
    }

    // Log the collected form data (for debugging purposes)
    console.log("Username:", username);
    console.log("Password:", password);
    console.log("Address:", address);
    console.log("Phone #:", phone);
    console.log("Email:", email);
    console.log("Max Hours:", maxHours);
    console.log("Parents:", parents);

    // Prepare the data object to send to the API
    const registerData = {
        name: username, 
        email: email, 
        phone: phone,
        address: address,
        password: password,
        max_hours: maxHours, 
        parents: parents 
    };

    // Use Fetch API to send register data to the server
    fetch('../backend/register.php', { // This is the PHP script handling the registration
        method: 'POST',
        body: new URLSearchParams(registerData)
    })
    .then(response => response.text())
    .then(data => {
        if (data === "Registration successful!") {
            // Show success message and redirect to profile page
            alert("Registration successful!");
            window.location.href = "profile.php";
        } else if (data === "Email already exists!") {
            // Show an error if the email already exists
            alert("Email already exists!");
        } else {
            // Show generic error message
            alert("Error: " + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("There was an error with the registration. Please try again.");
    });
}
