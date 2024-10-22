<?php   
    session_start();
    $isLoggin = isset($_SESSION['user_id']);
    if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
        header('Location: ../login.php');
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pt2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $question = $_POST['question'];
    
        $sql = "INSERT INTO question (question) VALUES ('$question')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("added successfully!")</script>';
            header("Location: home_user.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $questions = mysqli_query($conn, "SELECT * FROM question");


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
        $answer_text = mysqli_real_escape_string($conn, $_POST['answer_text']);
        $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
        $user_id = $_SESSION['user_id'];
    
        $query = "INSERT INTO answers (question_id, user_id, answer_text) VALUES ($question_id, $user_id, '$answer_text')";
        
        if (mysqli_query($conn, $query)) {
            header('Location: home_user.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body{
      background-color: #495E57;
      color:white;
     }

     .bg-body-blue{
      background-color : #DDDDDD;
     }

     h1{
        color: white;
        text-align: center;
     }
     .answer-form { display: none; }
     .answers-list { margin-top: 10px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-blue sticky-top mb-3">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav navspace ms-auto text-center">
                <li class="nav-item me-3"></li>
                  <a class="nav-link active" aria-current="page" href="#"><strong>Home</strong></a>
                </li>

                <?php if ($isLoggin):?>
                  <li class="nav-item me-3"></li>
                  <a class="nav-link" aria-current="page" href="../logout.php"><strong>LogOut</strong></a>
                  </li>
                <?php else:?>
                  <li class="nav-item me-3"></li>
                <a class="nav-link" aria-current="page" href="../login.php"><strong>Login</strong></a>
                </li>

                <?php endif; ?>
              </ul>
            </div>
          </div>
        </nav>

        <h2>Question List</h2>
        <?php while ($question = mysqli_fetch_assoc($questions)): ?>
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title" onclick="toggleAnswerForm(<?php echo $question['q_id']; ?>)">
                    <?php echo $question['question']; ?>
                    </h5>
                    
                    <div id="answer-form-<?php echo $question['q_id']; ?>" class="answer-form mt-3">
                        <form action="home_user.php" method="POST">
                            <div class="mb-3">
                                <textarea class="form-control" name="answer_text" placeholder="Your answer..." required></textarea>
                            </div>
                            <input type="hidden" name="question_id" value="<?php echo $question['q_id']; ?>">
                            <button type="submit" name="answer" class="btn btn-sm btn-primary">Submit Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAnswerForm(questionId) {
            var answerForm = document.getElementById('answer-form-' + questionId);
            answerForm.style.display = (answerForm.style.display === 'none' || answerForm.style.display === '') ? 'block' : 'none'; // Toggle visibility
        }
    </script>
</body>
</html>
