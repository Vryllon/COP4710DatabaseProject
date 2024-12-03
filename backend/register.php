<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $max_hours = $_POST['max_hours'];
    $parents = json_decode($_POST['parents'], true); // Decode the parents JSON string

    // Start a transaction to ensure both caregiver and parents are created together
    $pdo->beginTransaction();

    try {
        // Insert caregiver into the Members table
        $sql = "INSERT INTO Members (Name, Email, Phone, Address, PasswordHash, MaxAvailableHoursPerWeek)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, $address, $password, $max_hours]);

        // Get the MemberID of the newly inserted caregiver
        $caregiver_id = $pdo->lastInsertId();

        // Loop through parents data and insert them into the Parents table
        foreach ($parents as $parent) {
            $sql = "INSERT INTO Parents (MemberID, Name, Age, HealthStatus, Address)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$caregiver_id, $parent['name'], $parent['age'], $parent['health'], $parent['address']]);
        }

        // Commit the transaction if both caregiver and parents are inserted
        $pdo->commit();
        
        echo "Registration successful!";
    } catch (PDOException $e) {
        // Rollback the transaction if there is any error
        $pdo->rollBack();
        
        if ($e->errorInfo[1] == 1062) {
            echo "Email already exists!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
