<?php
session_start();
include 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) { // Assuming role_id for User is 3
    header('Location: login.php');
    exit();
}

// Fetch all questions
$questions = mysqli_query($conn, "SELECT * FROM questions");

// Insert Answer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $answer_text = mysqli_real_escape_string($conn, $_POST['answer_text']);
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO answers (question_id, user_id, answer_text) VALUES ($question_id, $user_id, '$answer_text')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to avoid form resubmission
        header('Location: user_home.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .answer-form { display: none; } /* Hide answer forms by default */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Welcome, User!</h2>
        
        <h3>Questions:</h3>
        <?php while ($question = mysqli_fetch_assoc($questions)): ?>
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title" onclick="toggleAnswerForm(<?php echo $question['id']; ?>)">
                        <?php echo $question['question_text']; ?>
                    </h5>
                    
                    <!-- Answer form (initially hidden, shows when clicking on the question) -->
                    <div id="answer-form-<?php echo $question['id']; ?>" class="answer-form mt-3">
                        <form action="user_home.php" method="POST">
                            <div class="mb-3">
                                <textarea class="form-control" name="answer_text" placeholder="Your answer..." required></textarea>
                            </div>
                            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                            <button type="submit" name="answer" class="btn btn-sm btn-primary">Submit Answer</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>

    <!-- Bootstrap and JavaScript for toggling the answer form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to toggle answer form visibility
        function toggleAnswerForm(questionId) {
            var answerForm = document.getElementById('answer-form-' + questionId);
            answerForm.style.display = (answerForm.style.display === 'none' || answerForm.style.display === '') ? 'block' : 'none'; // Toggle visibility
        }
    </script>
</body>
</html>
