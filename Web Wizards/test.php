<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Login</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        font-family: 'Jost', sans-serif;
        background: linear-gradient(to bottom, rgb(41, 26, 41), rgb(140, 14, 140), rgb(82, 39, 82));
    }
    .main {
        width: 350px;
        height: 500px;
        background: red;
        overflow: hidden;
        background: url("img1.jpg") no-repeat center / cover;
        box-shadow: 5px 20px 50px #000;
    }
    #chk {
        display: none;
    }
    .signup {
        position: relative;
        width: 100%;
        height: 100%;
    }
    label {
        color: white;
        font-size: 2.3em;
        justify-content: center;
        display: flex;
        margin: 60px;
        font-weight: bold;
        cursor: pointer;
        transition: .5s ease-in-out;
    }
    input {
        width: 60%;
        height: 20%;
        background: white;
        justify-content: center;
        display: flex;
        margin: 20px auto;
        padding: 10px;
        border: none;
        outline: none;
        border-radius: 5px;
        color: purple;
    }
    button {
        width: 60%;
        height: 40px;
        margin: 10px auto;
        justify-content: center;
        display: block;
        color: white;
        background: rgb(140, 2, 140);
        font-size: 1em;
        font-weight: bold;
        margin-top: 20px;
        outline: none;
        border: none;
        border-radius: 5px;
        transition: .2s ease-in;
        cursor: pointer;
    }
    button:hover {
        background: rgb(80, 2, 80);
    }
    .login {
        height: 460px;
        background: white;
        border-radius: 60% / 10%;
        transform: translateY(-180px);
        transition: .8s ease-in-out;
    }
    .login input {
        color: purple;
    }
    .login label {
        color: purple;
        transform: scale(.6);
    }
    #chk:checked ~ .login {
        transform: translateY(-500px);
    }
    #chk:checked ~ .login label {
        transform: scale(1);
    }
    #chk:checked ~ .signup label {
        transform: scale(.6);
    }
</style>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form method="POST" action="register.php" id="signupForm">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" id="email" placeholder="Email" required="">
                <div id="emailError" style="color: red;"></div>
                <input type="password" name="pswd" placeholder="Password" required="">
                <button type="submit" name="signup">Sign up</button>
            </form>
        </div>
        <div class="login">
            <form method="POST" action="register.php">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <!-- JavaScript for validation -->
    <script>
        // Function to validate email
        function validateEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._-]+@vitstudent\.ac\.in$/;
            return emailPattern.test(email);
        }

        // Function to handle form submission for Sign Up
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;

            // Clear previous error messages
            document.getElementById('emailError').textContent = '';

            // Validate email
            if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = "Please enter a valid VIT email (ending with @vitstudent.ac.in).";
                event.preventDefault();
                return false;
            }
        });

        // Function to simulate checkbox click when clicking the "Sign In" button
        function switchToLogin() {
            document.getElementById('chk').checked = true;
        }

        // Add event listener to "Sign In" button to trigger the switch
        document.querySelector('button[name="signup"]').addEventListener('click', switchToLogin);
    </script>
</body>
</html>
