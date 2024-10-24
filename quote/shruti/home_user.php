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

$questions = mysqli_query($conn, "SELECT * FROM question");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $answer_text = mysqli_real_escape_string($conn, $_POST['answer_text']);
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
    $user_id = $_SESSION['user_id'];

    $uname = "SELECT name from  user where u_id =" . $question['u_id'];
    $conn ->query($uname);

    $query = "INSERT INTO answers (question_id, user_id, answer_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $question_id, $user_id, $answer_text);
    
    if ($stmt->execute()) {
        header('Location: home_user.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFFBF5; 
            color: #495E57; 
        }
        .bg-body-blue {
            background-color: #E4E0E1;
        }
        h1, h2 {
            color: #7743DB; 
            text-align: center;
        }
        .navbar {
            background-color: #C3ACD0; 
        }

        .nav-link {
            color: #FFFBF5 !important; 
        }

        .nav-link:hover {
            color: #E4E0E1 !important; 
        }

        .card {
            background-color: #E4E0E1; 
            border: none;
        }
        .btn-primary {
            background-color: #7743DB; 
            border: none; 
        }
        .btn-primary:hover {
            background-color: #C3ACD0; 
        }
        .answer-form { 
            display: none; 
        }
        .answers-list { 
            margin-top: 10px; 
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #7743DB; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-blue sticky-top mb-3">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navspace ms-auto text-center">
                <li class="nav-item me-3">
                    <a class="nav-link active" aria-current="page" href="#"><strong>Home</strong></a>
                </li>
                <?php if ($isLoggin): ?>
                    <li class="nav-item me-3">
                        <a class="nav-link" aria-current="page" href="../logout.php"><strong>LogOut</strong></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-3">
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
            <h5 class="card-title">
               <a href="que_detail.php?q_id=<?php echo $question['question']; ?>"> <?php echo $question['question']; ?> </a>
            </h5>

            <?php echo $question['description']; ?>

            <div class="row">
            <div class="date col-md-6"><strong>Created At:</strong><?php echo $question['created_at']; ?></div>
            <div class="user col-md-6">User:<?php  
                $uname_query = "SELECT name FROM user WHERE u_id =" . $question['u_id'];
                $uname_result = $conn->query($uname_query);
                $uname_row = $uname_result->fetch_assoc();
                echo $uname_row['name'];
            ?> ?></div>
            </div>


            <div id="answer-form-<?php echo $question['q_id']; ?>" class="answer-form mt-3">
                <form action="home_user.php" method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="answer_text" placeholder="Your answer..." required></textarea>
                    </div>
                    <input type="hidden" name="question_id" value="<?php echo $question['q_id']; ?>">
                    <button type="submit" name="answer" class="btn btn-sm btn-primary">Submit Comment</button>
                </form>

                <div class="answers-list">
                    <?php
                    $question_id = $question['q_id'];
                    $answers = mysqli_query($conn, "SELECT * FROM answers WHERE question_id = $question_id");

                    while ($answer = mysqli_fetch_assoc($answers)): ?>
                        <div class="alert alert-secondary mt-1">
                            <strong>User <?php echo $answer['user_id']; ?>:</strong> <?php echo $answer['answer_text']; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php $conn->close(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>
</body>
</html>
