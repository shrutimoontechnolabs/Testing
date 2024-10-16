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
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $date = $_POST['date'];
  $city = $_POST['city'];
  $gender = $_POST['gender'];

  //handle image
  $image = '';
  if(!empty([$_FILES]['image']['name'])){
    $image_name = basename([$_FILES]['image']['name']);
    $target_dir =  "uploads/";
    $target_file = $target_dir . $image_name;
    if (move_uploaded_file([$_FILES]['image']['tmp_name'], $target_file)){
      $image = $target_file;
    }
    else{
      echo "Error in uploading uimage";
    }
  }

  $sql = "INSERT INTO user (fname,lname, email, password, phone, image, date, city, gender) 
          values ('$fname' ,'$lname', '$email', '$password', '$phone', '$image', '$date', '$city', '$gender')";

  if ($conn->query($sql) === TRUE) {
   $u_id = $conn->insert_id;

  if(isset($_POST['hobby'])){
     $hobby = $_POST['hobby'];
     foreach($hobby as $h_id) {
      $hobby_sql = "INSERT INTO user_hobby (u_id, h_id) values ('$u_id', '$h_id')";
      $conn->query($hobby_sql);
  }
  }
  echo"Registration successful:";
  } 

  else{
    echo "error";
  }
 }
 $conn->close();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form-detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
   <style>
    body{
      background-color: #495E57;
     }

     .bg-body-blue{
      background-color :#DDDDDD;
     }
     h1{
        text-align: center;
        color: #ffffff;
     }
     .container{
        display: flex;
        align-items: center;
        justify-content: center;
     }
     form{
        width: 600px;
        background-color: #ffffff;
     }
     #detailform{
        padding: 20px;
     }
     .error{
        color: red;
     }
    </style>

</head>
<body>
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
                  
                  <li class="nav-item me-3"></li>
                  <a class="nav-link" aria-current="page" href="detail.html"><strong>Details</strong></a>
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

        <div>
            <h1>Details</h1>
        </div>  

        <div class="container">
            <form id="detailform" method="POST" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>FirstName</label>
                      <input type="text" class="form-control" placeholder="First name" name="fname" id="firstName" required>
                      <div class="text-danger" id="firstNameError"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>LastName</label>
                      <input type="text" class="form-control" placeholder="Last name" name="lname" id="lastName" required>
                      <div class="text-danger" id="lastNameError"></div>
                    </div>
                  </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Eg. example@email.com" name="email" id="email" required>
                    <div class="text-danger" id="emailError"></div>
                </div>

                <div class="row">
                    <div class=" col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="password" name="password" id="password" required>
                        <div class="text-danger" id="passwordError"></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="confirmpassword" name="confirmpassword" id="confirmpassword" required>
                        <div class="text-danger" id="confirmpasswordError"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="number" class="form-control" placeholder="Eg. 9825982525" name="phone" id="phone" required>
                    <div class="text-danger" id="phoneError"></div>
                </div>

                <div class="mb-3">
                    <label for="profilePic" class="form-label">Upload Profile Picture</label>
                    <input type="file" class="form-control" id="profilePic" name="image" accept="image/*" required>
                    <div class="text-danger" id="profilePicError"></div>
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                    <div class="text-danger" id="dateError"></div>
                </div>

                <div class="mb-3">
                    <label for="City" class="form-label">City</label>
                    <select class="form-select" id="city" name="city" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">Ahmedabad</option>
                        <option value="2">Surat</option>
                        <option value="3">Gandhinagar</option>
                      </select>
                      <div class="text-danger" id="cityError"></div>
                </div>

                <div class="row mb-3">
                    <label for="hobby">Hobby</label>
                    <div class="col-md-3 form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="dancing" id="hobbyDancing">
                        <label class="form-check-label" for="hobbyDancing">
                          Dancing
                        </label>
                      </div>
                      <div class="col-md-3 form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="sports" id="hobbySports">
                        <label class="form-check-label" for="hobbySports">
                          Sports
                        </label>
                      </div>

                      <div class="col-md-3 form-check">
                        <input class="form-check-input" type="checkbox" name="hobby[]" value="music" id="hobbyMusic">
                        <label class="form-check-label" for="hobbyMusic">
                          Music
                        </label>
                      </div>
                      <div class="text-danger" id="hobbiesError"></div>
                </div>

                <div class="row mb-3">
                    <label>Gender</label>

                    <div class=" col-md-6 form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale">
                        <label class="form-check-label" for="genderMale">
                          Male
                        </label>
                      </div>
                    <div class="col-md-6 form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale">
                        <label class="form-check-label" for="genderFemale">
                          Female 
                        </label>
                    </div>
                    <div class="text-danger" id="genderError"></div>
                </div>

                <button type="submit" class="btn send-btn btn-primary">Send Message</button>

            </form>
        </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-------------------Validation--------------------------->
    <!-- <script>
    $(document).ready(function(){
        $('#detailform').on('submit', function(e){
            e.preventDefault();
    
            // Clear all error messages
            $('.text-danger').text('');
    
            var firstName = $('#firstName').val().trim();
            var lastName = $('#lastName').val().trim();
            var email = $('#email').val().trim();
            var phone = $('#phone').val().trim();
            var password = $('#password').val().trim();
            var confirmPassword = $('#confirmpassword').val().trim();
            var city = $('#city').val();
            var hobbies = $('input[name="hobby[]"]:checked');
            var gender = $('input[name="gender"]:checked');
            
            var isValid = true;
    
            if (firstName === '') {
                $('#firstNameError').text('Please enter your first name.');
                isValid = false;
            }

            if (lastName === '') {
                $('#lastNameError').text('Please enter your last name.');
                isValid = false;
            }

            if (email === '') {
                $('#emailError').text('Please enter your email.');
                isValid = false;
            }

            if (phone === '') {
                $('#phoneError').text('Please enter your phone number.');
                isValid = false;
            }

            if (password === '') {
                $('#passwordError').text('Please enter a password.');
                isValid = false;
            }

            if (confirmPassword === '' || confirmPassword !== password) {
                $('#confirmpasswordError').text('Passwords do not match.');
                isValid = false;
            }

            if (city === 'Open this select menu') {
                $('#cityError').text('Please select a city.');
                isValid = false;
            }

            if (hobbies.length === 0) {
                $('#hobbiesError').text('Please select at least one hobby.');
                isValid = false;
            }

            if (!gender.length) {
                $('#genderError').text('Please select your gender.');
                isValid = false;
            }

            if (isValid) {
                alert("Form submitted successfully!"); 
                this.submit();
            }
        });
    });
    </script> -->

</body>
</html>
