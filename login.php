<?php
session_start();
include('connect.php');

// Checks if user is logged in
if (isset($_SESSION['user_name'])) {
  header("Location: edit.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <title>Centered Login Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #131313; /* Adjust to your background color */
    }
    .form-container {
      background-color: #080808; /* Adjust to your container background color */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-label {
      font-size: 1.5rem;
      color: #FFFFFF; /* Adjust to your text color */
    }
    .btn-primary {
      border-radius: 4px;
      background-color: #DA70D5; /* Adjust to your primary button color */
      border-color: #DA70D5; /* Adjust to your primary button border color */
    }
    .btn-primary:hover {
      background-color: #DA70D5; /* Adjust to your primary button hover color */
      border-color: #080808; /* Adjust to your primary button hover border color */
    }
    .col-12 {
      padding: 10px;
    }

    .input text {
        width: 5px;
        height: 5px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form class="row g-3" method="post" action="login-logic.php">
      <div class="col-12">
        <label for="inputUsername" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="inputUsername">
      </div>
      <div class="col-12">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword">
      </div>
      <div class="col-12 text-center">
        <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
      </div>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
