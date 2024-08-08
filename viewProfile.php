<?php
/* include db connection file */
include("dbconn.php");

// Retrieve user ID or username from request
$userID= @$_POST['user_id'];

//$userID= "11";

// Fetch user details from the database
$sql = "SELECT fullname, username, user_password, user_phone FROM user WHERE user_id = $userID";
$result = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());

while( $rowr= mysqli_fetch_row($query))
{
	$csvOutput[] = $rowr;
	
}

echo json_encode($csvOutput,JSON_UNESCAPED_UNICODE);
exit;
?>
