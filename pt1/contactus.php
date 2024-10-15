<?php
 session_start();

 if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
 }
 $isLoggin = isset($_SESSION['email']);
 
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "pt1";
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
 $name = $email = $number = $message = "";
 
 if (isset($_GET['c_id'])) {
     $c_id = intval($_GET['c_id']);
     
     $sql = "SELECT * FROM contact WHERE c_id = $c_id";
     $result = $conn->query($sql);
 
     if ($result && $result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $name = $row['name'];
         $email = $row['email'];
         $number = $row['number'];
         $message = $row['message'];
     } else {
         echo "No contact found with this ID.";
         exit();
     }
 }
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $message = $_POST['message'];
 
     if (isset($_GET['c_id'])) {
         $sql = "UPDATE contact SET name = '$name', email = '$email', number = '$number', message = '$message' WHERE c_id = $c_id";
         if ($conn->query($sql) === TRUE) {
             echo '<script>alert("Contact updated successfully!")</script>';
             header("Location: view_contact.php");
             exit();
         } else {
             echo "Error updating record: " . $conn->error;
         }
          } else {
         $sql = "INSERT INTO contact (name, number, email, message) VALUES ('$name', '$number', '$email', '$message')";
         if ($conn->query($sql) === TRUE) {
             echo '<script>alert("Contact added successfully!")</script>';
             header("Location: contactus.php");
             exit();
          }else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }
     }
 }
 
 $conn->close();
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
      background-color :#DDDDDD;
     }

     .contact-form {
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        width: 100%;
        max-width: 800px;
        margin: 0 auto; 
    }

    .contact-form input,
    .contact-form textarea {
      margin-bottom: 20px;
    }

    .form-control {
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      border-radius: 5px; 
    }

    .form-control:focus {
      border-color: #6A9C89;
      box-shadow: 0 0 5px rgba(106, 156, 137, 0.5); 
    }

    .btn-primary {
        background-color: #FDC351;
        width: 100%;
        padding: 10px;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #eeaa21;
    }

    .contact-section {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    background-color: #f8f9fa;
    position: relative;
    z-index: 2;
}

.contact-section::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url("./img/fullbuild.png");
    background-size: cover;
    background-position: center;
    opacity: 0.3;
    z-index: 1;
}
  
    .contact-section .contact-info {
      font-size: 18px;
      margin-bottom: 30px; 
    }

    .contact-info h4 {
      margin-bottom: 10px;
      font-weight: bold;
    }

    .contact-info p {
      line-height: 1.5;
    }

    .height-match {
      height: auto; 
    }

    </style>

</head>
<body class="min-height-100vh">
    <nav class="navbar navbar-expand-lg bg-body-blue sticky-top">
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

              <?php if ($isLoggin): ?>
              <li class="nav-item me-3"></li>
              <a class="nav-link" aria-current="page" href="logout.php"><strong>LogOut</strong></a>
              </li>
              <?php else: ?>
              <li class="nav-item me-3"></li>
              <a class="nav-link" aria-current="page" href="Login.php"><strong>Login</strong></a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>

      <p style="color:white"> <?php echo "Welcome " . $_SESSION['email'] . "!"; ?></p>

      <div class="contact">
        <div class="contact-container">
          <div class="row d-flex align-items-center justify-content-center">
            <div class="row align-items-stretch height-match p-4">
              <div class="col-md-6 contact-section height-match mb-3">
                <div class="contact-info">
                  <h4><i class="fas fa-map-marker-alt"></i>Address</h4>
                  <p>Ganesh Meridian, C 105A, Sarkhej - Gandhinagar Hwy, opp. Kargil Petrol Pump, Vishwas City 1, Sola, Ahmedabad, Gujarat 380060</p>
                  <h4 class="mt-4"><i class="fas fa-phone"></i>Let's Talk</h4>
                  <p>079 4005 5109</p>
                  <h4 class="mt-4"><i class="fas fa-envelope"></i>General Support</h4>
                  <p>sales@moontechnolabs.com</p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="contact-form">
                  <h3>Contact Us</h3>
                  <form id="contactForm" method="POST" action="" novalidate>
                    <div class="row">
                      <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="First name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        <div class="text-danger" id="nameError"></div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Eg. example@email.com" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                      <div class="text-danger" id="emailError"></div>
                    </div>
                    <div class="mb-3">
                      <input type="number" name="number" class="form-control" placeholder="Eg. 9825982525" id="number" value="<?php echo htmlspecialchars($number); ?>" required>
                      <div class="text-danger" id="numberError"></div>
                    </div>
                    <div class="mb-3">
                      <textarea name="message" class="form-control" placeholder="Write us a message" rows="4" id="message" required><?php echo htmlspecialchars($message); ?></textarea>
                      <div class="text-danger" id="messageError"></div>
                    </div>
                    <button type="submit" class="btn send-btn btn-primary">
                      <?php echo isset($_GET['c_id']) ? "Update Contact" : "Add Contact"; ?>
                    </button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
      e.preventDefault();

      $('#nameError, #emailError, #numberError, #messageError').text('');

      var name = $('#name').val().trim();
      var number = $('#number').val().trim();
      var email = $('#email').val().trim();
      var message = $('#message').val().trim();

      var isValid = true;

      if (name === '') {
        $('#nameError').text('Please enter your first name.');
        isValid = false;
      }

      if (email === '') {
        $('#emailError').text('Please enter your email address.');
        isValid = false;
      } else if (!validateEmail(email)) {
        $('#emailError').text('The email address you entered is not valid.');
        isValid = false;
      }

      if (number === '') {
        $('#numberError').text('Please enter your phone number.');
        isValid = false;
      } else if (!/^[0-9]{10}$/.test(number)) {
        $('#numberError').text('Please enter a valid 10-digit phone number.');
        isValid = false;
      }

      if (message === '') {
        $('#messageError').text('Please enter a message.');
        isValid = false;
      }

      if (isValid) {
        alert('Message sent successfully!');
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