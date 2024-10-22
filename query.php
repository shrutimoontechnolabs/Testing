<?php
include 'database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];

            if ($user['role_id'] == 1) {
                header('Location: home_admin.php'); 
            } else {
                header('Location: home_user.php');  
            }
            exit();
        } else {
            echo "Invalid login!";
        }
    } else {
        echo "Invalid login!";
    }
}
?>