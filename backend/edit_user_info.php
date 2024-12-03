<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $userID = $_SESSION['MemberID'];
    $name = $data['Name'];
    $email = $data['Email'];
    $phone = $data['Phone'];
    $location = $data['Address'];
    $maxhour = $data['MaxAvailableHoursPerWeek'];  // Ensure this matches the frontend

    try {
        $stmt = $pdo->prepare("
            UPDATE Members
            SET Name = ?, Email = ?, Phone = ?, Address = ?, MaxAvailableHoursPerWeek = ?
            WHERE MemberID = ?
        ");
        $stmt->execute([$name, $email, $phone, $location, $maxhour, $userID]);

        echo json_encode(['success' => true]);  // Change to 'success' key for consistency
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error updating profile: ' . $e->getMessage()]);
    }
}

?>
