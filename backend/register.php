<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $max_hours = $_POST['max_hours'];

    $sql = "INSERT INTO Members (Name, Email, Phone, Address, PasswordHash, MaxAvailableHoursPerWeek)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $email, $phone, $address, $password, $max_hours]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Email already exists!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
