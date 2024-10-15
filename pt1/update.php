<?php 
session_start();

$isLoggin = isset($_SESSION['email']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pt1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $name  = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $message = $_POST['message'];

if(isset($_GET['c_id'])){
    $c_id = intval($_GET['c_id']); 

    $sql = "UPDATE contact SET name = '$name' , number = '$number', email = '$email', message = '$message' Where c_id = $c_id ";
    
    if($conn->query($sql) === TRUE){
        echo '<script>alert("Record update")</script>';
        header("Location: contactus.php");
        exit(); 
    } else {
        echo '<script>alert("Error updating record")</script>';
    }
} else {
    echo '<script>alert("No Contact Id Provided")</script>';
}

$conn->close();
?>
