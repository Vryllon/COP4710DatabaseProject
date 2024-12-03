<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile - Caregiver Website</title>
</head>

<body>
    <div>
        <h1>
            <p id="profile">Profile Page</p>
        </h1>

        <div>
            <a href="contracts.php">contracts</a>
            <a href="search.php">search</a>
            <a href="profile.php">my profile</a>
        </div>

        <div id="profileInfo">
            <p id="balance"></p>
            <p id="address"></p>
            <p id="phone"></p>
            <p id="email"></p>
            <p id="name"></p>
            <p id="maxhours"></p>
            <p id="avgreview"></p>
        </div>

        <!-- Edit Profile Section -->
        <div id="editProfileSection" style="display:none;">
            <h2>Edit Profile</h2>
            <form id="editProfileForm">
                <!-- Editable fields for name, email, password -->
                <div>
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" name="name" required>
                </div>
                <br>
                <div>
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" required>
                </div>
                <br>
                
                <!-- Editable fields for address, phone -->
                <div>
                    <label for="editAddress">Address:</label>
                    <input type="text" id="editAddress" name="address">
                </div>
                <br>
                <div>
                    <label for="editPhone">Phone #:</label>
                    <input type="text" id="editPhone" name="phone">
                </div>
                <br>
                <div>
                    <label for="editMaxHours">Max Hours per week:</label>
                    <input type="text" id="editMaxHours" name="maxHours">
                </div>
                <br>

                <button type="button" onclick="saveProfileChanges()">Save Changes</button>
                <button type="button" onclick="cancelEditProfile()">Cancel</button>
            </form>
        </div>

        <div>
            <button onclick="editProfile()">Edit Profile</button>
        </div>
    </div>

    <script src="handleProfile.js"></script>
</body>
</html>
