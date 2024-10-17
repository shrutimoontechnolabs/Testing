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
        // If parent_id is null, insert only the title with NULL parent_id
        $stmt = $conn->prepare("INSERT INTO categories (title, parent_id) VALUES (?, NULL)") or die($conn->error);
        $stmt->bind_param("s", $title); 
    } else {
        // If parent_id is not null, insert both title and parent_id
        $stmt = $conn->prepare("INSERT INTO categories (title, parent_id) VALUES (?, ?)") or die($conn->error);
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
$result = $conn->query("SELECT * FROM categories");

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

// Function to build category tree
function buildTree(array &$categories, $parentId = null) {
    $branch = [];

    foreach ($categories as &$category) {
        // Check for both NULL and integer comparison
        if ($category['parent_id'] === $parentId || ($category['parent_id'] === null && $parentId === null)) {
            $children = buildTree($categories, $category['id']);
            if ($children) {
                $category['children'] = $children;
            }
            $branch[] = $category;
        }
    }

    return $branch;
}

// Build category tree starting with NULL for root categories
$categoryTree = buildTree($categories);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Structure</title>
    <style>
        .category { margin-left: 20px; }
    </style>
</head>
<body>

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

<h2>Category Structure</h2>

<!-- Function to display categories -->
<?php
function displayCategories($categories) {
    foreach ($categories as $category) {
        echo '<div class="category">' . htmlspecialchars($category['title']);
        if (isset($category['children'])) {
            echo '<div class="children">';
            displayCategories($category['children']);
            echo '</div>';
        }
        echo '</div>';
    }
}

// Display the category tree
displayCategories($categoryTree);
?>

</body>
</html>

<?php
$conn->close();
?>
