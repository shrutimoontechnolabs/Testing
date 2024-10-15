<?php

  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pt1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      $_SESSION['email'] = $email;
      header("Location: home.php");
      exit();
    } else {
      echo '<script>alert("error")</script>';
    }

    $conn->close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #495E57;
            color: rgb(0, 0, 0);
        }

        .login-container {
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 800px;
        }

        .btn {
            background-color: #FDC351;
        }

        .btn:hover {
            background-color: #eeaa21;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <h2 class="text-center">Login</h2>
        <form id="loginForm" method="POST" action="">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
              <div class="text-danger" id="emailError"></div>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              <div class="text-danger" id="passwordError"></div>
            </div>

            <div class="form-group form-check mb-3">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

            <button type="submit" class="btn w-100">Login</button>
            <div class="text-center mt-3">
              <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $('#emailError').text('');
                $('#passwordError').text('');

                var email = $('#email').val().trim();
                var password = $('#password').val().trim();

                var isValid = true;

                if (email === '') {
                  $('#emailError').text('Please enter your email address.');
                  isValid = false;
                } else if (!validateEmail(email)) {
                  $('#emailError').text('The email address you entered is not valid. Please check and try again.');
                  isValid = false;
                }

                if (password === '') {
                  $('#passwordError').text('Please enter your password.');
                  isValid = false;
                } else if (password.length < 6) {
                  $('#passwordError').text('Your password must be at least 6 characters long.');
                  isValid = false;
                }

                if (isValid) {
                  this.submit();  
                }
            });

            function validateEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
</body>
</html>
