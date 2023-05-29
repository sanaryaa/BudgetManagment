<?php session_start();
require_once "../includes/connect.php";

// Prepare SQL statement and execute
$sql1 = "DELETE FROM users WHERE user_id=" . $_SESSION["user_id"];


if (mysqli_query($con, $sql1) ) {
    session_destroy();
   header("location: ../signup.php");
} else {
    echo "Error deleting account: " . mysqli_error($con);
}

// Close database connection
mysqli_close($con);

?>
