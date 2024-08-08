<?php
include("dbconn.php");

$Username=@$_POST['u_username'];
$Password=@$_POST['u_password'];

// $Username='khalisss';
// $Password='khalis11';

$sql="SELECT * FROM user WHERE username = '$Username' AND user_password = '$Password'";
$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());

if (mysqli_num_rows($query)>0) //If the username and password are matched
{
	while( $rowr= mysqli_fetch_row($query))
	{
		$csvOutput[] = $rowr;
		
	}

	echo json_encode($csvOutput,JSON_UNESCAPED_UNICODE);
	exit;
	
}	
else  // If the username and password are invalid
{
	echo"error";
}
	
mysqli_free_result($query);
mysqli_close($dbconn);
?>