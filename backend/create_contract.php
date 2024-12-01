<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $caregiver_id = $_POST['caregiver_id'];
    $parent_id = $_POST['parent_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_hours = $_POST['total_hours'];

    $sql = "INSERT INTO Contracts (MemberID, CaregiverID, ParentID, StartDate, EndDate, TotalHours)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$member_id, $caregiver_id, $parent_id, $start_date, $end_date, $total_hours]);
        echo "Contract created successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
