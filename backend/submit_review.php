<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent from JavaScript
    $data = json_decode(file_get_contents('php://input'), true);
    $contractID = $data['contractID'];
    $memberID = $data['memberID'];
    $caregiverID = $data['caregiverID'];
    $rating = $data['rating']; // 1 to 5
    $review = $data['comment']; // Optional feedback

    // Initialize response array
    $response = ['success' => false, 'message' => ''];

    try {
        // Insert the review into the database
        $stmt = $pdo->prepare("INSERT INTO Reviews (ContractID, ReviewerID, CaregiverID, Rating, Comment) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$contractID, $memberID, $caregiverID, $rating, $review]);

        // Update caregiver's average rating
        $stmt = $pdo->prepare("
            UPDATE Members 
            SET Rating = (
                SELECT AVG(Rating)
                FROM Reviews 
                WHERE CaregiverID = ?
            )
            WHERE MemberID = ?
        ");
        $stmt->execute([$caregiverID, $caregiverID]);

        $response['success'] = true;
        $response['message'] = "Review submitted successfully.";
    } catch (PDOException $e) {
        // Catch any database errors and add to the response
        $response['message'] = "Error submitting review: " . $e->getMessage();
    }

    // Return the response as JSON
    echo json_encode($response);
}
?>
