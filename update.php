<?php
include("dbconn.php");

$userID = $_POST['user_id'];
$count = $_POST['count'];
$date = date('Y-m-d'); // Ensure you are recording the date in the same format as your database

$sql = "UPDATE cigarette_count SET count = count + ? WHERE user_id = ? AND date = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("iis", $count, $userID, $date);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'fail']);
}

$stmt->close();
$dbconn->close();
?>
