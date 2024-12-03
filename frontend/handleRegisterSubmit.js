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
    let parentCounter = 1; // Start counting parents
    while (formData.has(`parent${parentCounter}name`)) {
        const parentName = formData.get(`parent${parentCounter}name`);
        const parentAge = formData.get(`parent${parentCounter}age`);
        const parentHealth = formData.get(`parent${parentCounter}health`);
        const parentAddress = formData.get(`parent${parentCounter}address`);

        // Store parent data as an object
        parents.push({
            name: parentName,
            age: parentAge,
            health: parentHealth,
            address: parentAddress
        });

        parentCounter++;
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
        parents: JSON.stringify(parents) // Send parents as a JSON string
    };

    // Use Fetch API to send register data to the server
    fetch('../backend/register.php', { // This is the PHP script handling the registration
        method: 'POST',
        body: new URLSearchParams(registerData)
    })
    .then(response => response.text())
    .then(data => {
        if (data === "Registration successful!") {
            // Show success message and redirect to login page
            alert("Registration successful!");
            window.location.href = "login.php";
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
