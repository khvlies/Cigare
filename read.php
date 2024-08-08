<?php
include("dbconn.php");

$userID = @$_POST['user_id'];

$sql = "SELECT SUM(count) as total_count FROM cigarette_count WHERE user_id = $userID";
$result = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

$row = mysqli_fetch_assoc($result);

if ($row['total_count'] !== null) {
    $total_count = $row['total_count'];
} else {
    $total_count = 0;
}

echo $total_count;
exit;
?>
