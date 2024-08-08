<?php
/* include db connection file */
include("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['u_fullname'];
    $username = $_POST['u_username'];
    $pass = $_POST['u_password'];
    $phone = $_POST['u_phone'];

    // Prepare an SQL statement
    $stmt = $dbconn->prepare("INSERT INTO user (fullname, username, user_password, user_phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $pass, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data has been saved";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method";
}

// Close the connection
$dbconn->close();
?>
