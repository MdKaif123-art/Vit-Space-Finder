<?php
// Database connection
$servername = "localhost";  // Change if needed
$username = "root";         // Change to your database username
$password = "";             // Change to your database password
$dbname = "log";  // Change to your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $stmt = $con->prepare("SELECT id FROM signupclient WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If the email exists, show an error message
    if ($stmt->num_rows > 0) {
        echo "Error: This email is already registered.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query with placeholders for inserting new data
        $stmt = $con->prepare("INSERT INTO signupclient (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to sign-in page after successful sign-up
            header("Location: signinclient.php");
            exit(); // Terminate the script after redirecting
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>

<!-- Back Button -->
<a href="signupclient.html">
    <button style="padding: 10px 20px; background-color: #1b9a59; color: white; border: none; border-radius: 5px;">Back to Signup</button>
</a>
