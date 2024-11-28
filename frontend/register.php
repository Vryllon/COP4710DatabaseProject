<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Caregiver Website</title>
    <script src="handleRegisterSubmit.js"></script>
    <script src="handleParentField.js"></script>
</head>

<body>
    <div>
        <h1>Register</h1>

        <form id="registerForm" onsubmit="handleRegisterSubmit(event)">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <br>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <br>
            <div>
                <label for="phone">Phone #:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <br>

            <!-- Dynamic Parent Inputs Container -->
            <div id="parentsContainer">
                <p>Parent 1:</p>
                <div id="parent1name">
                    <label for="parent1name">Name:</label>
                    <input type="text" id="parent1name" name="parent1name" required>
                </div>
                <div id="parent1age">
                    <label for="parent1age">Age:</label>
                    <input type="text" id="parent1age" name="parent1age" required>
                </div>
                <div id="parent1health">
                    <label for="parent1health">Health:</label>
                    <input type="text" id="parent1health" name="parent1health" required>
                </div>
                <div id="parent1address">
                    <label for="parent1address">Address:</label>
                    <input type="text" id="parent1address" name="parent1address" required>
                </div>
            </div>

            <br>

            <!-- Buttons for adding/removing parent fields -->
            <button type="button" onclick="addParentField()">Add Another Parent</button>
            <button type="button" onclick="removeLastParentField()">Remove Last Parent</button>
            <br><br>

            <div>
                <button type="submit">Register</button>
            </div>
        </form>

        <a href="login.php" class="button">Use existing account</a>
    </div>
</body>
</html>
