window.onload = function() {
    // Fetch user data from the API
    fetch('../backend/get_user_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching user data:', data.error);
            } else {
                document.getElementById('name').innerText = `Name: ${data.Name}`;
                document.getElementById('email').innerText = `Email: ${data.Email}`;
                document.getElementById('phone').innerText = `Phone: ${data.Phone}`;
                document.getElementById('address').innerText = `Address: ${data.Address}`;
                document.getElementById('balance').innerText = `Balance: ${data.CareMoneyBalance}`;
                document.getElementById('avgreview').innerText = `Avg Rating: ${data.Rating}`;
                document.getElementById('maxhours').innerText = `Max Weekly Hours: ${data.MaxAvailableHoursPerWeek}`;
            }
        })
        .catch(error => {
            console.error('Error loading profile data:', error);
        });
};

function editProfile() {
    // Toggle between viewing profile and editing profile
    document.getElementById('profileInfo').style.display = 'none';
    document.getElementById('editProfileSection').style.display = 'block';

    // Prefill the form with current data (this can be dynamically filled)
    const name = document.getElementById('name').innerText.replace('Name: ', '');
    const email = document.getElementById('email').innerText.replace('Email: ', '');
    const phone = document.getElementById('phone').innerText.replace('Phone: ', '');
    const address = document.getElementById('address').innerText.replace('Address: ', '');
    const maxhours = document.getElementById('maxhours').innerText.replace('Max Weekly Hours: ', '');

    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editAddress').value = address;
    document.getElementById('editMaxHours').value = maxhours;
}

function cancelEditProfile() {
    // Revert back to the profile view
    document.getElementById('profileInfo').style.display = 'block';
    document.getElementById('editProfileSection').style.display = 'none';
}

function saveProfileChanges() {
    const updatedData = {
        Name: document.getElementById('editName').value,
        Email: document.getElementById('editEmail').value,
        Phone: document.getElementById('editPhone').value,
        Address: document.getElementById('editAddress').value,
        MaxAvailableHoursPerWeek: document.getElementById('editMaxHours').value,
    };

    // Log the data to ensure it's correct
    console.log(updatedData);

    fetch('../backend/edit_user_info.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully!');
            cancelEditProfile();  // Revert to the profile view

            // Update the profile display with new data
            document.getElementById('name').innerText = `Name: ${updatedData.Name}`;
            document.getElementById('email').innerText = `Email: ${updatedData.Email}`;
            document.getElementById('phone').innerText = `Phone: ${updatedData.Phone}`;
            document.getElementById('address').innerText = `Address: ${updatedData.Address}`;
            document.getElementById('maxhours').innerText = `Max Weekly Hours: ${updatedData.MaxAvailableHoursPerWeek}`;
        } else {
            alert('Error updating profile!');
        }
    })
    .catch(error => {
        alert('Error saving profile changes!');
        console.error('Error saving profile changes:', error);
    });
}
