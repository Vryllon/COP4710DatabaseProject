<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contractID = $_POST['contract_id'];
    $rating = $_POST['rating']; // 1 to 5
    $review = $_POST['review']; // Optional feedback

    try {
        // Insert the review into the database
        $stmt = $pdo->prepare("INSERT INTO Reviews (ContractID, Rating, Review) VALUES (?, ?, ?)");
        $stmt->execute([$contractID, $rating, $review]);

        // Update caregiver's average rating
        $stmt = $pdo->prepare("
            UPDATE Members 
            SET AvgRating = (
                SELECT AVG(Rating)
                FROM Reviews 
                WHERE CaregiverID = (SELECT CaregiverID FROM Contracts WHERE ContractID = ?)
            )
            WHERE MemberID = (SELECT CaregiverID FROM Contracts WHERE ContractID = ?)
        ");
        $stmt->execute([$contractID, $contractID]);

        echo "Review submitted successfully.";
    } catch (PDOException $e) {
        echo "Error submitting review: " . $e->getMessage();
    }
}
?>
