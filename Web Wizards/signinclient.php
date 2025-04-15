<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Fiverr Clone</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/5.15.4/css/all.min.css">
<style>
body {
    background-color: white;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    width: 100%;
    max-width: 400px;
    position: relative;
    text-align: center;
}
.logo {
    position: absolute;
    top: 10px;
    left: 10px;
}
img {
    width: 100px;
    padding: 50px;
}
.login-box {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 60px;
}
h2 {
    margin-bottom: 20px;
}
.input-field {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    position: relative;
}
.password-container {
    position: relative;
}
.toggle-password {
    position: absolute;
    right: 0px;
    top: 20px;
    cursor: pointer;
    color: rgb(140, 2, 140);
}
.continue-button {
    background-color: rgb(140, 2, 140); /* Updated to desired color */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    cursor: pointer;
    font-size: 16px;
    margin: 10px 0;
}
.continue-button:hover {
    background-color: rgb(130, 0, 130); /* Slightly darker shade on hover */
}
hr {
    margin: 20px 0;
}
p {
    font-size: 14px;
}
a {
    color: #007bff;
    text-decoration: none;
}
.error-message {
    color: rgb(140, 2, 140); /* Updated error message color */
    margin-bottom: 10px;
}
.back-button {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background-color: #ddd;
    color: rgb(140, 2, 140); /* Updated back button color */
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9em;
    transition: background-color 0.3s;
}
.back-button:hover {
    background-color: rgb(140, 2, 140); /* Hover effect with updated color */
    color: white;
}
</style>
</head>
<body>
<div class="logo">
<img src="logo-photoaidcom-cropped.jpg" alt="Logo" />
</div>
<div class="container">
<div class="login-box">
<?php
// Check if there's an error message
if (isset($_SESSION['error'])) {
    echo "<div class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</div>"; // Safely

    unset($_SESSION['error']); // Clear the message after displaying it
}
?>
<form action="connectsigninclient.php" method="post">
<h2>Sign in as a client</h2>
<input type="text" placeholder="Email" class="input-field" name="stname" required />
<div class="password-container">
<input type="password" id="password" name="pass" placeholder="Password (8 or more characters)" class="input-field" required />
<i class="far fa-eye-slash toggle-password" id="togglePassword" onclick="togglePassword()"></i>
</div>
<button type="submit" class="continue-button">Continue</button>
<hr />
</form>
<p>Don't know the password ? <a href="forgotpassword.php">Forgot password</a></p>
<p>I don't have an account? <a href="signupclient.html">Sign Up</a></p>
</div>
</div>
<a href="index.html" class="back-button">Back</a>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}
</script>
</body>
</html>
