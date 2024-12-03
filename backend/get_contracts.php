<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userID = $_SESSION['MemberID'];

    try {
        $stmt = $pdo->prepare("
            SELECT c.ContractID, c.StartDate, c.EndDate, c.TotalHours, c.HourlyRate * c.TotalHours AS Cost, 
                   m.Name AS CaregiverName, p.Name AS ParentName, p.ParentID, c.CaregiverID, c.MemberID
            FROM Contracts c
            JOIN Members m ON c.CaregiverID = m.MemberID
            JOIN Parents p ON c.ParentID = p.ParentID
            WHERE c.MemberID = ? OR c.CaregiverID = ?
        ");
        $stmt->execute([$userID, $userID]);
        $contracts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($contracts);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
