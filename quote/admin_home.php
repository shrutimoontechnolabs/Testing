<?php
session_start();
include 'database.php';

// Check if the admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: login.php');
    exit();
}

// Insert question
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_question'])) {
    $question_text = mysqli_real_escape_string($conn, $_POST['question_text']);
    $query = "INSERT INTO questions (question_text) VALUES ('$question_text')";
    
    if (mysqli_query($conn, $query)) {
        echo "Question added!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch all questions
$questions = mysqli_query($conn, "SELECT * FROM questions");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Welcome, Admin!</h2>
        
        <h3>Add New Question:</h3>
        <form action="admin_home.php" method="POST" class="mb-4">
            <div class="mb-3">
                <textarea class="form-control" name="question_text" placeholder="Enter your question here..." required></textarea>
            </div>
            <button type="submit" name="add_question" class="btn btn-primary">Add Question</button>
        </form>

        <h3>All Questions:</h3>
        <?php while ($question = mysqli_fetch_assoc($questions)): ?>
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">Question: <?php echo $question['question_text']; ?></h5>
                </div>
            </div>
        <?php endwhile; ?>

        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
