<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT MemberID, PasswordHash FROM Members WHERE Email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['PasswordHash'])) {
        $_SESSION['MemberID'] = $user['MemberID'];
        echo "Login successful!";
    } else {
        echo "Invalid email or password!";
    }
}
?>
