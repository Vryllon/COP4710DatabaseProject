<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $userID = $data['user_id'];
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $location = $data['location'];

    try {
        $stmt = $pdo->prepare("
            UPDATE Members
            SET Name = ?, Email = ?, Phone = ?, Location = ?
            WHERE MemberID = ?
        ");
        $stmt->execute([$name, $email, $phone, $location, $userID]);

        echo json_encode(['message' => 'User info updated successfully.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
