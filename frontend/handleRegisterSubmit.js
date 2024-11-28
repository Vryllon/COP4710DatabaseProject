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

    // Initialize an array to collect parent values
    const parents = [];

    // Iterate through the FormData entries to collect data for "parent" fields
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('parent')) {
            parents.push(value); // Collect parent data
        }
    }

    // REMOVE AFTER NEXT SECTION IS UNCOMMENTED
    console.log("Username:", username);
    console.log("Password:", password);
    console.log("Address:", address);
    console.log("Phone #:", phone);
    console.log("Parents:", parents);
    localStorage.setItem('username', username);
    localStorage.setItem('profile', username);

    // Redirect to the profile page
    window.location.href = "profile.php";

    // UNCOMMENT AND CHANGE WHEN BACKEND IS READY
    // const registerData = { username, password, address, phone, parents };

    // Use Fetch API to send register data to the server
    // fetch('http://localhost:3000/register', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //     },
    //     body: JSON.stringify(registerData)  // Send register data as JSON
    // })
    // .then(response => response.json())  // Assuming the server responds with JSON
    // .then(data => {
    //     if (data.success) {
    //         // Save user_id in localStorage
    //         localStorage.setItem('user_id', data.user_id);  

    //         // Redirect to another page (e.g., dashboard)
    //         window.location.href = "profile.php";
    //     } else {
    //         // Show an error message if login fails
    //         alert(data.message || "Cannot create an account with that information!");
    //     }
    // })
    // .catch(error => {
    //     console.error('Error:', error);
    // });
}
