
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "user");
if (!$con) {
    die("Connection error: " . mysqli_connect_error());
}


if (!isset($_SESSION['userName'])) {
    die("You must be logged in to change your password.");
}

if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userName = $_SESSION['userName'];

    
    $sql = "SELECT Password FROM users WHERE Username='$userName'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_password = $user['Password'];

      
        if ($currentPassword === $stored_password) {
          
            if ($newPassword === $confirmPassword) {
               
                $update_sql = "UPDATE users SET Password='$newPassword' WHERE Username='$userName'";
                if ($con->query($update_sql) === TRUE) {
                    echo '<script type="text/javascript">alert("Password changed successfully.")</script>';
                    
                    session_destroy();
                    header("refresh:2;url=login.php");
                    exit;
                } else {
                    echo '<script type="text/javascript">alert("Error updating password: ")</script>' . $con->error;
                }
            } else {
                echo '<script type="text/javascript">alert("New passwords do not match.")</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Invalid current password.")</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("User Not Found")</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,400;1,900&display=swap" rel="stylesheet">
	<title>Change Password</title>
	<style>
		body{
			background-image: url("project/sli2.jpg");
		}
		form{
			margin: auto;
			width:350px;
			height: 450px;
			font-family: 'poppins';
			margin-top: 130px;
			border-radius:10px;
			background-color: rgb(47,35,30,.5);
		}
		h1{
			text-align: center;
			color: white;
		}
		h6{
			margin-top: 0;
			margin-bottom: 10px;
			margin-left:30px;
			color: black;
			font-size: 20px;
			font-family: 'poppins';
		}
		input{
			margin-bottom: 10px;
			margin-left:30px;
			height: 30px;
			width: 250px;
			border:2px solid white;
			border-radius: 10px;
			font-family: 'poppins';
		}	
		button{
			margin-left: 100px;
			margin-top: 20px;
			width: 150px;
			height: 40px;
			background-color: blueviolet;
			border: 1px solid blueviolet;
			font-size: 16px;
			border-radius: 10px;
			color: white;
			font-family: "Times New Roman";
			font-weight: bolder;
			cursor: pointer;
		}
	</style>
</head>

<body>
<?php
include 'side_menu.php'
?>
<div class="main-content">
	<form action="settings.php" method="post">
		<h1>Welcome </h1>
		<h6>Current Password</h6>
		<input type="password" name="currentPassword" placeholder="Enter Current Password" required>
		<h6>New Password</h6>
		<input type="password" name="newPassword" placeholder="Enter New Password" required>
		<h6>Confirm New Password</h6>
		<input type="password" name="confirmPassword" placeholder="Confirm New Password" required>
		<button type="submit" name="changePassword">Change Password</button>
	</form>
    </div>
</body>
</html>

