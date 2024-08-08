<?php
include("dbconn.php");

$userID = @$_POST['user_id'];
$date = date('Y-m-d'); // Ensure you are recording the date in the same format as your database

// Query to get the current count for today
$check_sql = "SELECT count FROM cigarette_count WHERE user_id = ? AND date = ?";
$check_stmt = $dbconn->prepare($check_sql);
$check_stmt->bind_param("is", $userID, $date);
$check_stmt->execute();
$check_stmt->store_result();
$check_stmt->bind_result($current_count);
$check_stmt->fetch();

if ($check_stmt->num_rows > 0) {
    if ($current_count > 0) {
        // Decrement the count by 1
        $new_count = $current_count - 1;
        
        // Update the count in the database
        $update_sql = "UPDATE cigarette_count SET count = ? WHERE user_id = ? AND date = ?";
        $update_stmt = $dbconn->prepare($update_sql);
        $update_stmt->bind_param("iis", $new_count, $userID, $date);
        $update_stmt->execute();
        
        if ($update_stmt->affected_rows > 0) {
            echo json_encode(['status' =>'success', 'new_count' => $new_count]);
        } else {
            echo json_encode(['status' =>'fail', 'message' => 'Error updating count']);
        }
        $update_stmt->close();
    } else {
        echo json_encode(['status' =>'fail', 'message' => 'Count is already zero']);
    }
} else {
    echo json_encode(['status' =>'fail', 'message' => 'No record found for today']);
}

$check_stmt->close();
$dbconn->close();
?>
