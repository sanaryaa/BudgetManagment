<?php
session_start();
require_once './includes/connect.php';

if (isset($_POST['updateFood'])) {
	$food_id = $_POST['food_id'];
	$item_name = $_POST['itemName'];
	$price = $_POST['price'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE food_items SET item_name= '$item_name', price = '$price', date= '$date' WHERE food_id = '$food_id'");

	header("location: food.php");
} else if (isset($_POST['updateShopping'])) {
	$shop_id = $_POST['shop_id'];
	$item_name = $_POST['itemName'];
	$price = $_POST['price'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE shopping_items SET item_name= '$item_name', price = '$price', date= '$date' WHERE shop_id = '$shop_id'");

	header("location: shopping.php");
} else if (isset($_POST['updateHealth'])) {
	$health_id = $_POST['health_id'];
	$item_name = $_POST['itemName'];
	$price = $_POST['price'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE health_items SET item_name= '$item_name', price = '$price', date= '$date' WHERE health_id = '$health_id'");

	header("location: health.php");
} else if (isset($_POST['updateOthers'])) {
	$others_id = $_POST['others_id'];
	$item_name = $_POST['itemName'];
	$price = $_POST['price'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE other_items SET item_name= '$item_name', price = '$price', date= '$date' WHERE others_id = '$others_id'");

	header("location: others.php");
} else if (isset($_POST['updateLent'])) {
	$lent_id = $_POST['lent_id'];
	$person_name = $_POST['person_name'];
	$amount = $_POST['amount'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE lent_items SET person_name= '$person_name', amount = '$amount', date= '$date' WHERE lent_id = '$lent_id'");

	header("location: lent.php");
} else if (isset($_POST['updateborrow'])) {
	$borrow_id = $_POST['borrow_id'];
	$person_name = $_POST['person_name'];
	$amount = $_POST['amount'];
	$date = $_POST['date'];

	mysqli_query($con, "UPDATE borrow_items SET person_name= '$person_name', amount = '$amount', date= '$date' WHERE borrow_id = '$borrow_id'");

	header("location: borrow.php");
} else if (isset($_POST['updateProfile'])) {
	$user_id = $_POST['user_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$email = $_POST['email'];

	$errors = array();

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($errors, "Email is not valid");
	}

	$sql = "SELECT * FROM users WHERE email = ? AND email != ?";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $email, $_SESSION['email']);
	mysqli_stmt_execute($stmt);
	$result1 = mysqli_stmt_get_result($stmt);
	$rowCount1 = mysqli_num_rows($result1);

	if ($rowCount1 > 0) {
		array_push($errors, "Email already exists!");
	}
	$sql = "SELECT * FROM users WHERE username = ? AND username != ?";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $username, $_SESSION['username']);
	mysqli_stmt_execute($stmt);
	$result2 = mysqli_stmt_get_result($stmt);
	$rowCount2 = mysqli_num_rows($result2);

	if ($rowCount2 > 0) {
		array_push($errors, "username already exists!");
	}
	if (count($errors) > 0) {
		// Concatenate the elements of the $errors array into a single string
		$error_string = implode(" & ", $errors);

		// urlencode() is a PHP function that is used to encode a string for use in a URL query string
		header("Location: profile.php?error_message=" . urlencode($error_string));
	} else if (!($first_name == $_SESSION['first_name']) or $last_name == $_SESSION['last_name'] or $first_name == $_SESSION['first_name'] or !($last_name == $_SESSION['last_name'])) {
		$sql = "UPDATE users SET first_name= ?, last_name = ?, username= ?, email= ? WHERE user_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name, $username, $email, $user_id);
		mysqli_stmt_execute($stmt);
		session_destroy();
		header("Location: signIn.php");
	} else {
		header("Location: profile.php");
	}
}