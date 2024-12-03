function searchUsers() {
    const searchQuery = document.getElementById('addressSearch').value.trim();
    const userList = document.getElementById('userList');
    
    // Clear the user list before adding new results
    userList.innerHTML = '';

    if (searchQuery.length < 3) {
        return; // Avoid unnecessary requests if search query is too short
    }

    // Send the search query to the backend
    fetch(`../backend/search_by_address.php?address=${encodeURIComponent(searchQuery)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                userList.innerHTML = `<p>Error: ${data.error}</p>`;
            } else if (data.message) {
                userList.innerHTML = `<p>${data.message}</p>`;
            } else {
                // Populate the results
                data.forEach(user => {
                    const userItem = document.createElement('div');
                    userItem.classList.add('user-item');
                    userItem.innerHTML = `
                        <strong>${user.Name}</strong>
                        <p>Location: ${user.Address}</p>
                        <p>Rating: ${user.Rating}</p>
                        <p>Available Hours: ${user.AvailableHours}</p>
                    `;
                    userList.appendChild(userItem);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            userList.innerHTML = `<p>An error occurred while fetching data.</p>`;
        });
}
