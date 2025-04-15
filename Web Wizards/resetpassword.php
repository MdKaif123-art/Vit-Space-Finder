<?php
require "_dbconnect.php";
session_start();
if (!isset($_SESSION['otp_sent']) || $_SESSION['otp_sent'] != true) {
    header("location: signin.php");
    exit;
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_SESSION['otp']) && isset($_SESSION['otp_sent'])) {
            $user_otp = $_POST['otp'];
            if ($user_otp == $_SESSION['otp']) {
                $_SESSION['otp_verfied'] = true;
                header("location: newpassword.php");
                exit;
            } else {
                header("location: resetpassword.php");
                $_SESSION['otp_verfied'] = false;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify OTP</title>
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
    color: rgb(140, 2, 140); /* Updated container text color */
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
    background-color: rgb(140, 2, 140); /* Updated input background */
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
    background-color: #900772; /* Darker shade for hover effect */
    transform: scale(1.05);
}
.error {
    color: red; /* Error message color remains red */
}
</style>
</head>
<body>
<div class="login-container">
    <h2>SkillScape</h2>
    <form method="post" action="resetpassword.php">
        <?php
        if ($_SESSION['otp_sent'] == false || !isset($_SESSION['otp_sent']) ||
            time() > $_SESSION['otp_expiration'] || !$_SESSION['otp_verfied']) {
            echo '<p class="error">*Invalid OTP</p>';
        }
        ?>
        <label for="otp"><small>OTP sent successfully <br></small></label>
        <input type="text" class="form-input" id="otp" placeholder="Enter OTP" name="otp" required>
        <button type="submit" class="login-button">Submit</button>
    </form>
</div>
</body>
</html>
