// Global variable to hold the users data
let usersData = [];

// Fetch users from the API and populate the list
async function fetchUsers() {
    try {
        const response = await fetch(API_URL + '/users'); // Replace with your API URL
        const data = await response.json();
        
        // Store the users data globally
        usersData = data;
        
        // Display all users initially
        displayUsers(usersData);
    } catch (error) {
        console.error('Error fetching users:', error);
    }
}

// Function to display users in the list
function displayUsers(users) {
    const userListContainer = document.getElementById('userList');
    userListContainer.innerHTML = ''; // Clear the previous list

    // If there are no users, show a message
    if (users.length === 0) {
        userListContainer.innerHTML = '<p>No users found.</p>';
        return;
    }

    // Display each user in the list
    users.forEach(user => {
        const userItem = document.createElement('div');
        userItem.className = 'user-item';
        userItem.innerHTML = `
            <strong>${user.name}</strong><br>
            Address: ${user.address}<br>
            Phone: ${user.phone}<br>
            Email: ${user.email}
        `;
        userListContainer.appendChild(userItem);
    });
}

// Function to handle the search based on address input
function searchUsers() {
    const searchQuery = document.getElementById('addressSearch').value.toLowerCase();

    // Filter users based on the search query (match any part of the address)
    const filteredUsers = usersData.filter(user => user.address.toLowerCase().includes(searchQuery));

    // Display filtered users
    displayUsers(filteredUsers);
}

// Fetch users when the page loads
window.onload = fetchUsers;