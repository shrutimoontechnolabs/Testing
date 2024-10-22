<?php
session_start();
include 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
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

// Insert Reply
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'])) {
    $reply_text = mysqli_real_escape_string($conn, $_POST['reply_text']);
    $answer_id = mysqli_real_escape_string($conn, $_POST['answer_id']);
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO replies (answer_id, user_id, reply_text) VALUES ($answer_id, $user_id, '$reply_text')";
    
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
        .reply-form { display: none; } /* Hide reply forms by default */
        .reply-btn { cursor: pointer; color: blue; } /* Style reply button */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Welcome, User!</h2>
        
        <h3>Questions:</h3>
        <?php while ($question = mysqli_fetch_assoc($questions)): ?>
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">Question: <?php echo $question['question_text']; ?></h5>
                    
                    <!-- Display answers -->
                    <?php
                    $question_id = $question['id'];
                    $answers = mysqli_query($conn, "SELECT * FROM answers WHERE question_id = $question_id");
                    while ($answer = mysqli_fetch_assoc($answers)): ?>
                        <div class="mb-3">
                            <p><strong>User <?php echo $answer['user_id']; ?>:</strong> <?php echo $answer['answer_text']; ?></p>
                            
                            <!-- Display replies only if there are any -->
                            <?php
                            $answer_id = $answer['id'];
                            $replies = mysqli_query($conn, "SELECT * FROM replies WHERE answer_id = $answer_id");
                            if (mysqli_num_rows($replies) > 0): ?>
                                <div class="ms-3">
                                    <h6>Replies:</h6>
                                    <?php while ($reply = mysqli_fetch_assoc($replies)): ?>
                                        <p><strong>User <?php echo $reply['user_id']; ?>:</strong> <?php echo $reply['reply_text']; ?></p>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Reply form toggle button (Instagram-like icon) -->
                            <span class="reply-btn" onclick="toggleReplyForm(<?php echo $answer['id']; ?>)">
                                <i class="bi bi-chat-left-text"></i> Reply
                            </span>
                            
                            <!-- Reply form (initially hidden, shows when clicking on the reply icon) -->
                            <div id="reply-form-<?php echo $answer['id']; ?>" class="reply-form mt-3">
                                <form action="user_home.php" method="POST">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="reply_text" placeholder="Your reply..." required></textarea>
                                    </div>
                                    <input type="hidden" name="answer_id" value="<?php echo $answer['id']; ?>">
                                    <button type="submit" name="reply" class="btn btn-sm btn-outline-primary">Submit Reply</button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <!-- Answer form -->
                    <form action="user_home.php" method="POST">
                        <div class="mb-3">
                            <textarea class="form-control" name="answer_text" placeholder="Your answer..." required></textarea>
                        </div>
                        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" name="answer" class="btn btn-sm btn-primary">Submit Answer</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>

        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>

    <!-- Bootstrap and JavaScript for toggling the reply form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to toggle reply form visibility
        function toggleReplyForm(answerId) {
            var replyForm = document.getElementById('reply-form-' + answerId);
            replyForm.style.display = (replyForm.style.display === 'none' || replyForm.style.display === '') ? 'block' : 'none'; // Toggle visibility
        }
    </script>
</body>
</html>
