<?php
session_start();

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online-food-order";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission (if submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();
    if ($row['user_type'] == 'user') {
      $_SESSION['user_id'] = $row['id'];
      header("Location: home.php");
    } else {
      $_SESSION['admin_id'] = $row['id'];
      header("Location: admin.php");
    }
  } else {
    // Login failed
    $login_error = "Invalid username or password";
  }

  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student/Admin Login</title>
    <style>
        body {
          font-family: sans-serif;
          margin: 0;
          padding: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          background-color: #f5f5f5;
        }

        .container {
          background-color: #fff;
          padding: 30px;
          border-radius: 5px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
          text-align: center;
          margin-bottom: 20px;
        }

        label {
          display: block;
          margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 3px;
          margin-bottom: 15px;
        }

        button {
          background-color: #4CAF50;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 3px;
          cursor: pointer;
        }

        button:hover {
          opacity: 0.8;
        }

        p {
          text-align: center;
        }

        a {
          color: #4CAF50;
          text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>LOGIN</h1>
        <?php if (isset($login_error)) : ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="username">UserName:</label>
            <input type="username" name="username" id="username" placeholder="UserName" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>New user? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
