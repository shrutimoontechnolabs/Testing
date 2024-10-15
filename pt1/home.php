<?php

  session_start();

  $isLoggin = isset($_SESSION['email']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body{
      background-color: #495E57;
     }

     .bg-body-blue{
      background-color : #DDDDDD;
     }

     h1{
        color: white;
        text-align: center;
     }
    </style>
</head>
<body>
    <body class="min-height-100vh">
        <nav class="navbar navbar-expand-lg bg-body-blue sticky-top mb-3">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav navspace ms-auto text-center">
                <li class="nav-item me-3"></li>
                  <a class="nav-link active" aria-current="page" href="home.php"><strong>Home</strong></a>
                </li>
    
                <li class="nav-item me-3"></li>
                <a class="nav-link active" aria-current="page" href="view_contact.php"><strong>View Contact</strong></a>
                </li>

                <li class="nav-item me-3"></li>
                  <a class="nav-link" aria-current="page" href="contactus.php"><strong>Contact</strong></a>
                </li>

                <?php if ($isLoggin):?>
                  <li class="nav-item me-3"></li>
                  <a class="nav-link" aria-current="page" href="logout.php"><strong>LogOut</strong></a>
                  </li>
                <?php else:?>
                  <li class="nav-item me-3"></li>
                <a class="nav-link" aria-current="page" href="Login.php"><strong>Login</strong></a>
                </li>

                <?php endif; ?>
              </ul>
            </div>
          </div>
        </nav>

        <!---------------------Main Section----------------------------------------->

        <div class="main-content" mb-3>
        <h1>Welcome to our platform!<br> We aim to provide the best service possible. Here, you can explore various features and connect with others.</h1>

          <div class="row justify-content-center mt-5">
            <div class="col-md-4">
              <div class="card">
                <h3>Service 1</h3>
                <p>Our first amazing service description goes here. We offer quality solutions that fit your needs.</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <h3>Service 2</h3>
                <p>Explore our second service, providing you with tailored features to improve your experience.</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <h3>Service 3</h3>
                <p>Our third service focuses on innovative solutions to make your work easier and more efficient.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Section -->
      <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
      </footer>
</body>
</html>