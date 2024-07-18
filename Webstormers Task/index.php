<?php  
$con = mysqli_connect("localhost", "root", "", "user");
if (!$con) {
    die("connection error");
}

if (isset($_POST['signup'])) {
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    if ($userName !== '' && $passWord !== '') {
        $sql = "INSERT INTO users (Username,Password) VALUES ('$userName','$passWord')";
        $con->query($sql);
        
        header("refresh:2;url=login.php");
    } else {
        echo '<script type="text/javascript">alert("Enter Username and Password Must")</script>';
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
    <title>PROJECT</title>
    <style>
        body {
            background-image: url("project/sli2.jpg");
        }
        form {
            margin: auto;
            width: 350px;
            height: 350px;
            font-family: 'poppins';
            margin-top: 130px;
            border-radius: 10px;
            background-color: rgb(47, 35, 30, .5);
        }
        h1 {
            text-align: center;
            color: white;
        }
        h6 {
            margin-top: 0;
            margin-bottom: 10px;
            margin-left: 30px;
            color: white;
            font-size: 20px;
            font-family: 'poppins';
        }
        input {
            margin-bottom: 10px;
            margin-left: 30px;
            height: 30px;
            width: 250px;
            border: 2px solid white;
            border-radius: 10px;
            font-family: 'poppins';
        }   
        button {
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
        a {
            text-decoration: none !important;
            color: red;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="index.php" method="post">
        <h1>Sign Up</h1>
        <h6>User Name</h6>
        <input type="text" name="userName" placeholder="User name" class="box">
        <h6>Password</h6>
        <input type="password" name="passWord" placeholder="Enter Your Password" class="box">
        <button name="signup">Sign Up</button>
        <p><a href='login.php'>Click here to Login</a></p>
    </form>
</body>
</html>
