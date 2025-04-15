<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Retrieve form data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);
// Validate the data
$errors = [];
if (empty($name)) {
$errors[] = 'Name is required.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errors[] = 'Enter a valid email.';
}
if (empty($subject)) {
$errors[] = 'Subject is required.';
}
if (empty($message)) {
$errors[] = 'Message is required.';
}
// Only proceed if there are no errors
if (empty($errors)) {
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "log");
// Check connection
if (!$con) {
die("Connection failed: " . mysqli_connect_error());
}
// Insert data into the database
$stmt = $con->prepare("INSERT INTO contactus (name, email, subject, message) VALUES (?, ?, ?,
?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);
// Execute and check for success
if ($stmt->execute()) {
echo '<div class="success">Thank you! Your message has been sent successfully.</div>';
echo '<script>
setTimeout(function() {
window.location.href = "index.html";
}, 2000); // Redirect after 3 seconds
</script>';
} else {
echo '<div class="error">Error: Could not submit your message. Please try again later.</div>';
}
// Close the statement and connection
$stmt->close();
mysqli_close($con);
} else {
// Display validation errors
foreach ($errors as $error) {
echo "<div class='error'>$error</div>";
}
}
} else {
echo "Invalid request method.";
}
?>