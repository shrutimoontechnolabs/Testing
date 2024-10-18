<?php
// Database connection setup
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "structure"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add a category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $parent_id = empty($_POST['parent_id']) ? null : $_POST['parent_id']; // Use NULL for no parent

    // Prepare the SQL statement
    if ($parent_id === null) {
        $stmt = $conn->prepare("INSERT INTO navcategories (title, parent_id) VALUES (?, NULL)") or die($conn->error);
        $stmt->bind_param("s", $title); 
    } else {
        $stmt = $conn->prepare("INSERT INTO navcategories (title, parent_id) VALUES (?, ?)") or die($conn->error);
        $stmt->bind_param("si", $title, $parent_id);  
    }

    // Execute the statement
    $stmt->execute();
    $stmt->close();

    // Redirect to the same page after successful submission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit; // Make sure to exit after the redirect
}

// Fetch all categories from the database
$categories = [];
$result = $conn->query("SELECT * FROM navcategories");

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

// Function to build category tree
function buildTree(array &$categories, $parentId = null) {
    $branch = []; // This will hold the current set of categories

    foreach ($categories as &$category) { // Go through each category
        // Check if this category is a child of the given parent
        if ($category['parent_id'] === $parentId) {
            $children = buildTree($categories, $category['id']); // Find any children
            if ($children) { // If children exist
                $category['children'] = $children; // Add them to the current category
            }
            $branch[] = $category; // Add the current category to the branch
        }
    }

    return $branch; // Return the full branch
}

// Build category tree starting with NULL for root categories
$categoryTree = buildTree($categories);
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
        <label for="title">Category Title:</label>
        <input type="text" name="title" id="title" required><br><br>
        
        <label for="parent_id">Parent Category:</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option> <!-- Use empty value to represent no parent -->
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
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
                <?php foreach ($categoryTree as $category): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown<?= $category['id'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= htmlspecialchars($category['title']) ?>
                        </a>
                        <?php if (isset($category['children'])): ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown<?= $category['id'] ?>">
                                <?php displayDropdown($category['children']); ?>
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
        echo '<a class="dropdown-item dropdown-toggle" href="#">' . htmlspecialchars($child['title']) . '</a>';
        
        // Check for grandchildren
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
'''