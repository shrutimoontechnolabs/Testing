{
    // Place your snippets for php here. Each snippet is defined under a snippet name and has a prefix, body and 
    // description. The prefix is what is used to trigger the snippet and the body will be expanded and inserted. 
    // Possible variables are: $1, $2 for tab stops, $0 for the final cursor position, 
    // and ${1:label}, ${2:another} for placeholders. Placeholders with the same ids are connected.

    "MySQL Database Connection": {
        "prefix": "dbconfig", // Trigger text
        "body": [
            "\\$servername = '${1:localhost}';",  // Server name
            "\\$username = '${2:root}';",          // Database username
            "\\$password = '${3:}';",               // Database password
            "\\$dbname = '${4:databasename}';",     // Database name
            "",
            "// Create connection",
            "\\$conn = mysqli_connect(\\$servername, \\$username, \\$password, \\$dbname);",
            "",
            "// Check connection",
            "if (!\\$conn) {",
            "    die('Connection failed: ' . mysqli_connect_error());",
            "}",
        ],
        "description": "Create a MySQL database connection" // Description of the snippet
    },
	"MySQL Insert Operation": {
        "prefix": "dbinsert", // Trigger text
        "body": [
            "if ($_SERVER['REQUEST_METHOD'] == 'POST') {",
            "    \\$${1:var1} = mysqli_real_escape_string(\\$conn, \\$_POST['${2:input_field_1}']);",
            "    \\$${3:var2} = mysqli_real_escape_string(\\$conn, \\$_POST['${4:input_field_2}']);",
            "    \\$${5:var3} = mysqli_real_escape_string(\\$conn, \\$_POST['${6:input_field_3}']);",
            "",
            "    \\$query = 'INSERT INTO ${7:table_name} (${8:column1}, ${9:column2}, ${10:column3}) VALUES (?, ?, ?);';",
            "    \\$stmt = \\$conn->prepare(\\$query);",
            "    \\$stmt->bind_param('ssi', \\$${1:var1}, \\$${3:var2}, \\$${5:var3});",  // Adjust data types as needed
            "",
            "    if (\\$stmt->execute()) {",
            "        header('Location: ${11:redirect_page}.php');",
            "        exit();",
            "    } else {",
            "        echo 'Error: ' . \\$stmt->error;",
            "    }",
            "}"
        ],
        "description": "MySQL Insert operation snippet"
    },

    // Snippet for MySQL Select Operation
    "MySQL Select Operation": {
        "prefix": "dbselect", // Trigger text
        "body": [
            "\\$query = 'SELECT * FROM ${1:table_name} WHERE ${2:column_name} = \\$${3:variable};';",
            "\\$result = \\$conn->query(\\$query);",
            "",
            "if (\\$result->num_rows > 0) {",
            "    while (\\$row = \\$result->fetch_assoc()) {",
            "        echo \\$row['${4:column_name}'];", // Adjust to fetch specific columns if needed
            "        // Additional field outputs can be added here",
            "    }",
            "} else {",
            "    echo 'No results found.';",
            "}"
        ],
        "description": "MySQL Select operation snippet"
    },

    // Snippet for MySQL Update Operation
    "MySQL Update Operation": {
        "prefix": "dbupdate", // Trigger text
        "body": [
            "if ($_SERVER['REQUEST_METHOD'] == 'POST') {",
            "    \\$query = 'UPDATE ${1:table_name} SET ${2:column1} = ?, ${3:column2} = ? WHERE ${4:condition};';",
            "    \\$stmt = \\$conn->prepare(\\$query);",
            "    \\$stmt->bind_param('ss', \\$${5:value1}, \\$${6:value2});", // Adjust data types as needed
            "",
            "    if (\\$stmt->execute()) {",
            "        echo 'Record updated successfully.';",
            "    } else {",
            "        echo 'Error updating record: ' . \\$stmt->error;",
            "    }",
            "}"
        ],
        "description": "MySQL Update operation snippet"
    },

    // Snippet for MySQL Delete Operation
    "MySQL Delete Operation": {
        "prefix": "dbdelete", // Trigger text
        "body": [
            "if ($_SERVER['REQUEST_METHOD'] == 'POST') {",
            "    \\$query = 'DELETE FROM ${1:table_name} WHERE ${2:condition};';",
            "    \\$stmt = \\$conn->prepare(\\$query);",
            "",
            "    if (\\$stmt->execute()) {",
            "        echo 'Record deleted successfully.';",
            "    } else {",
            "        echo 'Error deleting record: ' . \\$stmt->error;",
            "    }",
            "}"
        ],
        "description": "MySQL Delete operation snippet"
    },
	"PHP Logout Functionality": {
        "prefix": "dblogout", // Trigger text
        "body": [
            "session_start();",
            "",
            "// Unset all of the session variables",
            "session_unset();",
            "",
            "// Destroy the session",
            "session_destroy();",
            "",
            "// Redirect to login page after logout",
            "header('Location: ${1:login_page}.php');",
            "exit();",
        ],
        "description": "Logout user: clear session, destroy, and redirect"
    },
	"File Upload": {
        "prefix": "dbupload", 
        "body": [
            "if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {",
            "    // Define upload directory and file name",
            "    \\$uploadDir = 'uploads/';",
            "    \\$fileName = basename($_FILES['file']['name']);",
            "    \\$targetFile = \\$uploadDir . \\$fileName;",
            "",
            "    // Move uploaded file to target directory",
            "    if (move_uploaded_file($_FILES['file']['tmp_name'], \\$targetFile)) {",
            "        echo 'File uploaded successfully.';",
            "    } else {",
            "        echo 'Error uploading file.';",
            "    }",
            "}",
        ],
        "description": "Handle file uploads in PHP"
    },
	"User Authentication Check": {
        "prefix": "dbauth", 
        "body": [
			"session_start();",
            "",
            "// Check if user is authenticated; replace 'your_user_id_variable' with your actual session variable name",
            "if (!isset($_SESSION['${1:your_user_id_variable}'])) {",
            "    header('Location: ${2:login_page}.php');",
            "    exit();",
            "}",
        ],
        "description": "Check if user is authenticated, redirect if not"
    }
}
