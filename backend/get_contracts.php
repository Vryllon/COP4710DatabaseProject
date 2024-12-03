<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userID = $_GET['user_id'];

    try {
        $stmt = $pdo->prepare("
            SELECT c.ContractID, c.StartDate, c.EndDate, c.TotalHours, c.TotalHours * 30 AS Cost, 
                   m.Name AS CaregiverName, p.Name AS ParentName
            FROM Contracts c
            JOIN Members m ON c.CaregiverID = m.MemberID
            JOIN Parents p ON c.ParentID = p.ParentID
            WHERE c.MemberID = ?
        ");
        $stmt->execute([$userID]);
        $contracts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($contracts);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
