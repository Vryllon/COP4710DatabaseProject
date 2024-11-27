// This function is called when the form is submitted
function handleLoginSubmit(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the form data
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // REMOVE AFTER NEXT SECTION IS UNCOMMENTED
    console.log("Username:", username);
    console.log("Password:", password);
    localStorage.setItem('username', username);
    localStorage.setItem('profile', username);
    window.location.href = "profile.php";
    
    // UNCOMMENT AND CHANGE WHEN BACKEND IS READY
    //const loginData = { username, password };

    // Use Fetch API to send login data to the server
    // fetch('http://localhost:3000/login', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //     },
    //     body: JSON.stringify(loginData)  // Send login data as JSON
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
    //         alert(data.message || "Invalid username or password!");
    //     }
    // })
    // .catch(error => {
    //     console.error('Error:', error);
    // });
}

