<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Caregiver Website</title>
    <script src="handleLoginSubmit.js"></script>
</head>

<body>
    <div>
        <h1>Login</h1>

        <form id="loginForm" onsubmit="handleLoginSubmit(event)">
            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <br>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>

        <a href="register.php" class="button">Make new account</a>
    </div>
</body>