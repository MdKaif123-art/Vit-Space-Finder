<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Contact us for any inquiries or questions about VitSpaceFinder." />
  <meta name="keywords" content="VIT, contact us, inquiries, VitSpaceFinder" />
  <meta name="author" content="VitSpaceFinder Team" />
  <title>Contact Us - VitSpaceFinder</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>
  <style>
    /* General Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Arial", sans-serif;
      scroll-behavior: smooth;
    }
    body {
      background-color: #fce4f8;
      color: #333;
    }
    h1,
    h2,
    h3 {
      color: rgb(140, 2, 140);
      font-weight: bold;
    }
    a {
      text-decoration: none;
      color: rgb(140, 2, 140);
    }
    a:hover {
      color: #900772;
    }
    
    /* Navbar Styling */
    .navbar {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 15px 30px;
      background-color: rgb(140, 2, 140);
      color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .navbar-logo img {
      width: 80px;
    }
    .navbar a {
      color: white;
      margin-left: 20px;
      font-size: 1rem;
    }
    .navbar a:hover {
      color: #900772;
    }

    /* Contact Form Section */
    .contact-section {
      padding: 50px 20px;
      text-align: center;
      background-color: white;
      margin-top: 20px;
    }
    .contact-section h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }
    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 15px;
      margin-bottom: 15px;
      border: 2px solid #f4c4e3;
      border-radius: 5px;
      font-size: 1rem;
    }
    .contact-form button {
      background-color: rgb(140, 2, 140);
      color: white;
      border: none;
      padding: 15px 25px;
      font-size: 1.2rem;
      border-radius: 5px;
      cursor: pointer;
    }
    .contact-form button:hover {
      background-color: #900772;
    }
    
    /* Footer */
    footer {
      background-color: rgb(140, 2, 140);
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 20px;
      font-size: 0.9rem;
    }

    /* Responsive Design Adjustments */
    @media (max-width: 768px) {
      .contact-form input,
      .contact-form textarea {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-logo">
      <img src="logo-photoaidcom-cropped.jpg" alt="VitSpaceFinder Logo" />
    </div>
    <a href="index.html">Home</a>
    <a href="service.html">Services</a>
    <a href="insta.html">About Us</a>
    <a href="contactus.php">Contact Us</a>
  </div>

  <!-- Contact Form Section -->
  <section class="contact-section">
    <h2>Contact Us</h2>

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
          if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Insert data into the database
          $stmt = $con->prepare("INSERT INTO contactus (name, email, subject, message) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("ssss", $name, $email, $subject, $message);

          // Execute and check for success
          if ($stmt->execute()) {
            echo '<div class="success">Thank you! Your message has been sent successfully.</div>';
            echo '<script>
                    setTimeout(function() {
                      window.location.href = "index.html";
                    }, 2000);
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
      }
    ?>

    <!-- Contact Form -->
    <form action="contactus.php" method="POST" class="contact-form">
      <input type="text" name="name" placeholder="Your Name" required />
      <input type="email" name="email" placeholder="Your Email" required />
      <input type="text" name="subject" placeholder="Subject" required />
      <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 VitSpaceFinder - All Rights Reserved.</p>
  </footer>
</body>
</html>
