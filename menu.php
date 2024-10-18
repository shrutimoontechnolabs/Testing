<?php
// Database connection setup
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "pt1"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu = $_POST['menu'];
    $parent_id = empty($_POST['parent_id']) ? null : $_POST['parent_id']; 

    if ($parent_id === null) {
        $stmt = $conn->prepare("INSERT INTO menu (menu, parent_id) VALUES (?, NULL)") or die($conn->error);
        $stmt->bind_param("s", $menu); 
    } else {
        $stmt = $conn->prepare("INSERT INTO menu (menu, parent_id) VALUES (?, ?)") or die($conn->error);
        $stmt->bind_param("si", $menu, $menu);  
    }

    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit; 
}

$menus = [];
$result = $conn->query("SELECT * FROM menu");

while ($row = $result->fetch_assoc()) {
    $menus[] = $row;
}

function buildMenu(array &$menus, $parentId = null) {
    $branch = [];

    foreach ($menus as &$menu) {
        if ($menu['parent_id'] === $parentId) {
            $children = buildMenu($menus, $menu['id']); 
            if ($children) { 
                $menu['children'] = $children;
            }
            $branch[] = $menu;
        }
    }

    return $branch;
}

$menuTree = buildMenu($menus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Dropdown</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            display: none;
            z-index: 1000;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add Category</h1>

    <!-- Category Form -->
    <form method="POST">
        <label for="menu">Menu:</label>
        <input type="text" name="menu" id="menu" required><br><br>
        
        <label for="parent_id">Parent Category:</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            <?php foreach ($menus as $menu): ?>
                <option value="<?= $menu['id'] ?>"><?= $menu['menu'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button type="submit">Save</button>
    </form>

    <h2>Navbar Structure</h2>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($menuTree as $menu): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown<?= $menu['id'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= htmlspecialchars($menu['menu']) ?>
                        </a>
                        <?php if (isset($menu['children'])): ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown<?= $menu['id'] ?>">
                                <?php displayDropdown($menu['children']); ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</div>

<!-- Function to display dropdown recursively -->
<?php
function displayDropdown($children) {
    foreach ($children as $child) {
        echo '<div class="dropdown-submenu">';
        echo '<a class="dropdown-item dropdown-toggle" href="#">' . htmlspecialchars($child['menu']) . '</a>';
        
        if (isset($child['children'])) {
            echo '<div class="dropdown-menu">';
            displayDropdown($child['children']); // Recursive call
            echo '</div>';
        }
        echo '</div>';
    }
}
?>

<!-- Scripts for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>