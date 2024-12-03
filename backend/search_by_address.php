<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $address = isset($_GET['address']) ? $_GET['address'] : '';

    // Ensure that address is provided
    if (empty($address)) {
        echo json_encode(['error' => 'No address provided']);
        exit;
    }

    try {
        // Prepare and execute the query
        $stmt = $pdo->prepare("
            SELECT MemberID, Name, Address, Rating, MaxAvailableHoursPerWeek AS AvailableHours
            FROM Members
            WHERE Address LIKE :address
        ");
        $stmt->execute(['address' => "%$address%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo json_encode($results); // Return results as JSON
        } else {
            echo json_encode(['message' => 'No results found']);
        }
    } catch (PDOException $e) {
        // Return detailed error message for debugging
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
