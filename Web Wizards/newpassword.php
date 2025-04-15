<?php
session_start();
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['otp_verfied']) || !$_SESSION['otp_verfied']) {
        header("location: resetpassword.php");
        exit;
    } else {
        require "_dbconnect.php";
        $user_mail = $_SESSION['email'];
        $pass = $_POST['password'];
        // Hash the password before storing it in the database
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE signupclient SET password = '$hashed_password' WHERE email = '$user_mail'";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            $valid = false;
        } else {
            header("location: signinclient.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: rgb(140, 2, 140); /* Updated text color */
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            color: rgb(140, 2, 140); /* Updated color */
        }
        .login-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: rgb(140, 2, 140); /* Updated heading color */
        }
        .form-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: rgb(140, 2, 140); /* Updated background color */
            color: #FFF;
        }
        .login-button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: rgb(140, 2, 140); /* Updated button color */
            border: none;
            color: #FFF;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .login-button:hover {
            background-color: #900772; /* Darker shade for hover */
            transform: scale(1.05);
        }
        .text {
            color: red; /* Error message color */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>SkillScape</h2>
        <form method="post" action="newpassword.php">
            <?php
            if (!$valid) {
                echo '<p class="text">Unable to change your password</p>';
            }
            ?>
            <label for="password"><small>Enter New Password <br></small></label>
            <input type="password" class="form-input" id="password" placeholder="Enter new Password"
                   name="password" required>
            <button type="submit" class="login-button">Submit</button>
        </form>
    </div>
</body>
</html>
