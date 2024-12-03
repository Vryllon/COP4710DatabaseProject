<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $address = $_GET['address'];

    try {
        $stmt = $pdo->prepare("
            SELECT MemberID, Name, Location, AvgRating, MaxAvailableHours - UsedHours AS AvailableHours
            FROM Members
            WHERE Location LIKE ?
        ");
        $stmt->execute(["%$address%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($results);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
