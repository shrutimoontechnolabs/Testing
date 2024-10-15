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

if(isset($_GET['c_id'])){
    $c_id = intval($_GET['c_id']); 

    $sql = "DELETE FROM contact WHERE c_id = $c_id";
    
    if($conn->query($sql) === TRUE){
        echo '<script>alert("Record Deleted")</script>';
        header("Location: view_contact.php");
        exit(); 
    } else {
        echo '<script>alert("Error deleting record")</script>';
    }
} else {
    echo '<script>alert("No Contact Id Provided")</script>';
}

$conn->close();
?>
