<?php
include("dbconn.php");

$userID = $_POST['user_id'];
$count = $_POST['count'];
$date = date('Y-m-d'); // Ensure you are recording the date in the same format as your database

// Check if a record for today already exists
$check_sql = "SELECT * FROM cigarette_count WHERE user_id = ? AND date = ?";
$check_stmt = $dbconn->prepare($check_sql);
$check_stmt->bind_param("is", $userID, $date);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    // Record exists, update it
    $update_sql = "UPDATE cigarette_count SET count = count + ? WHERE user_id = ? AND date = ?";
    $update_stmt = $dbconn->prepare($update_sql);
    $update_stmt->bind_param("iis", $count, $userID, $date);
    $update_stmt->execute();
    
    if ($update_stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'fail']);
    }
    $update_stmt->close();
} else {
    // Record does not exist, create it
    $insert_sql = "INSERT INTO cigarette_count (user_id, count, date) VALUES (?, ?, ?)";
    $insert_stmt = $dbconn->prepare($insert_sql);
    $insert_stmt->bind_param("iis", $userID, $count, $date);
    $insert_stmt->execute();

    if ($insert_stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'fail']);
    }
    $insert_stmt->close();
}

$check_stmt->close();
$dbconn->close();
?>
