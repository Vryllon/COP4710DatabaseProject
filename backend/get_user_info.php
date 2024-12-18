<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userID = $_SESSION['MemberID'];

    try {
        $stmt = $pdo->prepare("
            SELECT Name, Email, Phone, Address, CareMoneyBalance, Rating, MaxAvailableHoursPerWeek
            FROM Members
            WHERE MemberID = ?
        ");
        $stmt->execute([$userID]);
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($userInfo);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
