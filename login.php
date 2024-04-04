<?php 
session_start(); 
include "conn.php";
if (isset($_POST['uname'], $_POST['password'])) {
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	if (empty($uname)) {
		redirectWithError("Username is missing!");
	} elseif (empty($pass)) {
		redirectWithError("Password is missing!");
	} else {
		$sql = "SELECT * FROM uporabniki WHERE user_name='$uname' AND password='$pass'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user_name'] === $uname && $row['password'] === $pass) {
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				redirectTo("index2.php");
			} else {
				redirectWithError("Wrong username or password");
			}
		} else {
			redirectWithError("Wrong username or password");
		}
	}
} else {
	redirectTo("index2.php");
}
function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function redirectWithError($error) {
	header("Location: index.php?error=" . urlencode($error));
	exit();
}
function redirectTo($location) {
	header("Location: $location");
	exit();
}
