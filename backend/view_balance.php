<?php
require 'config.php';
session_start();

$memberID = $_SESSION['member_id']; // Assuming the user is logged in

try {
    $stmt = $pdo->prepare("SELECT CareMoney FROM Members WHERE MemberID = ?");
    $stmt->execute([$memberID]);
    $balance = $stmt->fetchColumn();

    echo "Your current balance: $balance Care Dollars";
} catch (PDOException $e) {
    echo "Error retrieving balance: " . $e->getMessage();
}
?>
