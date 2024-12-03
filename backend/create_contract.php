<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the current logged-in user's MemberID from the session
    $caregiver_id = $_SESSION['MemberID'];
    
    // Get the form data (caregiver email, parent name, contract details)
    $member_email = $_POST['caregiver_email'];  // Email of the caregiver (another user)
    $parent_name = $_POST['parent_name'];          // Parent name associated with the caregiver
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_hours = $_POST['total_hours'];
    $hourly_rate = $_POST['hourly_rate'];

    try {
        // Fetch Caregiver's MemberID using the caregiver's email
        $stmt = $pdo->prepare("SELECT MemberID FROM Members WHERE Email = ?");
        $stmt->execute([$member_email]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$member) {
            echo "Error: Member not found with the given email.";
            exit;
        }
        $member_id = $member['MemberID'];

        // Fetch the Parent's ID based on the parent name associated with the caregiver
        $stmt = $pdo->prepare("SELECT ParentID FROM Parents p
                               JOIN Members m ON p.MemberID = m.MemberID
                               WHERE m.Email = ? AND p.Name = ?");
        $stmt->execute([$member_email, $parent_name]);
        $parent = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$parent) {
            echo "Error: Parent not found with the given name and caregiver's email.";
            exit;
        }
        $parent_id = $parent['ParentID'];

        // Insert the contract into the Contracts table
        $sql = "INSERT INTO Contracts (MemberID, CaregiverID, ParentID, StartDate, EndDate, TotalHours, HourlyRate)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$member_id, $caregiver_id, $parent_id, $start_date, $end_date, $total_hours, $hourly_rate]);

        echo "Contract created successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
