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

$limit = 3;  
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) as total FROM contact";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

$sql = "SELECT c_id, name, email, number, message FROM contact LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error: " . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
    body{
      background-color:#495E57;
     }

     .bg-body-blue{
      background-color : #DDDDDD;
     }

     h1{
      color: white;
      text-align: center;
      margin-bottom: 20px;
     }

     .bi-pencil-square{
      color: Blue;
     }
     .bi-pencil-square:hover{
      color: darkblue;
     }

     .bi-trash{
      color:red;
     }
     .bi-trash:hover{
      color: darkred;
     }

     .page-link{
      color: DarkGreen;
     }
     
     .page-link:hover{
      background-color:  #DDDDDD;
      color: black;
     }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-blue sticky-top mb-4">
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

      <div>
        <h1>Contact Details</h1>
      </div>

      <div>
        <table class="table contain">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Message</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php 
                if ($result && $result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td> $row[c_id] </td>";
                    echo "<td> $row[name] </td>";
                    echo "<td> $row[email] </td>";
                    echo "<td> $row[number] </td>";
                    echo "<td> $row[message] </td>";
                    echo "<td>";
                    echo  "<a href='contactus.php?c_id=".$row['c_id']."' class='bi bi-pencil-square p-2'></a> ";
                    echo  "<a href='delete.php?c_id=".$row['c_id']."' class='bi bi-trash' onclick='return confirm(\"Are you sure you want to delete this record?\");'></a> ";
                    echo "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='6' class='text-center'>No contacts found.</td></tr>";
                }
              ?>
            </tr>
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if ($page <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
          </li>
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php if ($i == $page) { echo 'active'; } ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
          <?php endfor; ?>
          <li class="page-item <?php if ($page >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
          </li>
        </ul>
      </nav>
      </div>
</body>
</html>
