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
    },
    // prefix: sqlinsert - Insert new records into a table
    // prefix: sqlselect - Select records from a table
    // prefix: sqlupdate - Update existing records in a table
    // prefix: sqldelete - Delete records from a table
    // prefix: sqlinnerjoin - Join two tables using Inner Join
    // prefix: sqlleftjoin - Join two tables using Left Join
    // prefix: sqlcount - Count records in a table
    // prefix: sqlgroupby - Group records by a column
    // prefix: sqldistinct - Select distinct values from a column
    // prefix: sqlorderby - Sort records by a column
    // prefix: sqllimit - Limit the number of records returned
    // prefix: sqlhaving - Filter groups using Having clause
    // prefix: sqlbetween - Filter records within a range
    // prefix: sqllike - Search records by pattern using LIKE
    // prefix: sqlin - Filter records matching a list of values
    // prefix: sqladdcolumn - Add a new column to a table
    // prefix: sqldropcolumn - Remove a column from a table
    // prefix: sqlmodifycolumn - Modify the data type of a column
    // prefix: sqlcreatetable - Create a new table
    // prefix: sqldroptable - Delete a table
    // prefix: sqljointables - Join multiple tables
    // prefix: sqlunion - Combine results from multiple queries
    // prefix: sqlcreateindex - Create an index on a column
    // prefix: sqldropindex - Drop an index from a table

     // SQL Insert Query
     "SQL Insert Query": {
        "prefix": "sqlinsert",
        "body": [
            "INSERT INTO ${1:table_name} (${2:column1}, ${3:column2}, ${4:column3})",
            "VALUES ('${5:value1}', '${6:value2}', '${7:value3}');"
        ],
        "description": "Basic SQL Insert Query"
    },

    // SQL Select Query
    "SQL Select Query": {
        "prefix": "sqlselect",
        "body": [
            "SELECT ${1:*} FROM ${2:table_name}",
            "WHERE ${3:column_name} = '${4:value}';"
        ],
        "description": "Basic SQL Select Query"
    },

    // SQL Update Query
    "SQL Update Query": {
        "prefix": "sqlupdate",
        "body": [
            "UPDATE ${1:table_name}",
            "SET ${2:column1} = '${3:value1}', ${4:column2} = '${5:value2}'",
            "WHERE ${6:condition};"
        ],
        "description": "Basic SQL Update Query"
    },

    // SQL Delete Query
    "SQL Delete Query": {
        "prefix": "sqldelete",
        "body": [
            "DELETE FROM ${1:table_name}",
            "WHERE ${2:condition};"
        ],
        "description": "Basic SQL Delete Query"
    },

    // SQL Inner Join Query
    "SQL Inner Join Query": {
        "prefix": "sqlinnerjoin",
        "body": [
            "SELECT ${1:table1.column1}, ${2:table2.column2}",
            "FROM ${3:table1}",
            "INNER JOIN ${4:table2} ON ${3:table1}.${5:common_column} = ${4:table2}.${5:common_column};"
        ],
        "description": "SQL Inner Join Query"
    },

    // SQL Left Join Query
    "SQL Left Join Query": {
        "prefix": "sqlleftjoin",
        "body": [
            "SELECT ${1:table1.column1}, ${2:table2.column2}",
            "FROM ${3:table1}",
            "LEFT JOIN ${4:table2} ON ${3:table1}.${5:common_column} = ${4:table2}.${5:common_column};"
        ],
        "description": "SQL Left Join Query"
    },

    // SQL Count Query
    "SQL Count Query": {
        "prefix": "sqlcount",
        "body": [
            "SELECT COUNT(${1:*})",
            "FROM ${2:table_name}",
            "WHERE ${3:column_name} = '${4:value}';"
        ],
        "description": "SQL Count Query"
    },

    // SQL Group By Query
    "SQL Group By Query": {
        "prefix": "sqlgroupby",
        "body": [
            "SELECT ${1:column1}, COUNT(${2:column2})",
            "FROM ${3:table_name}",
            "GROUP BY ${1:column1};"
        ],
        "description": "SQL Group By Query"
    },
    // SQL Distinct Query
    "SQL Distinct Query": {
        "prefix": "sqldistinct",
        "body": [
            "SELECT DISTINCT ${1:column_name}",
            "FROM ${2:table_name};"
        ],
        "description": "SQL Distinct Query to get unique values"
    },

    // SQL Order By Query
    "SQL Order By Query": {
        "prefix": "sqlorderby",
        "body": [
            "SELECT ${1:column_name}",
            "FROM ${2:table_name}",
            "ORDER BY ${3:column_name} ${4:ASC|DESC};"
        ],
        "description": "SQL Order By Query to sort results"
    },

    // SQL Limit Query
    "SQL Limit Query": {
        "prefix": "sqllimit",
        "body": [
            "SELECT ${1:*}",
            "FROM ${2:table_name}",
            "LIMIT ${3:10};"
        ],
        "description": "SQL Limit Query to limit number of rows returned"
    },

    // SQL Having Query
    "SQL Having Query": {
        "prefix": "sqlhaving",
        "body": [
            "SELECT ${1:column_name}, COUNT(${2:column_name})",
            "FROM ${3:table_name}",
            "GROUP BY ${1:column_name}",
            "HAVING COUNT(${2:column_name}) > ${4:value};"
        ],
        "description": "SQL Having Query to filter groups"
    },

    // SQL Between Query
    "SQL Between Query": {
        "prefix": "sqlbetween",
        "body": [
            "SELECT ${1:column_name}",
            "FROM ${2:table_name}",
            "WHERE ${3:column_name} BETWEEN '${4:value1}' AND '${5:value2}';"
        ],
        "description": "SQL Between Query to filter results between a range"
    },

    // SQL Like Query
    "SQL Like Query": {
        "prefix": "sqllike",
        "body": [
            "SELECT ${1:column_name}",
            "FROM ${2:table_name}",
            "WHERE ${3:column_name} LIKE '${4:%pattern%}';"
        ],
        "description": "SQL Like Query to match a pattern in column values"
    },

    // SQL In Query
    "SQL In Query": {
        "prefix": "sqlin",
        "body": [
            "SELECT ${1:column_name}",
            "FROM ${2:table_name}",
            "WHERE ${3:column_name} IN ('${4:value1}', '${5:value2}', '${6:value3}');"
        ],
        "description": "SQL In Query to match any of the specified values"
    },

    // SQL Alter Table - Add Column Query
    "SQL Alter Table Add Column": {
        "prefix": "sqladdcolumn",
        "body": [
            "ALTER TABLE ${1:table_name}",
            "ADD ${2:column_name} ${3:datatype};"
        ],
        "description": "SQL Query to add a column to a table"
    },

    // SQL Alter Table - Drop Column Query
    "SQL Alter Table Drop Column": {
        "prefix": "sqldropcolumn",
        "body": [
            "ALTER TABLE ${1:table_name}",
            "DROP COLUMN ${2:column_name};"
        ],
        "description": "SQL Query to drop a column from a table"
    },

    // SQL Alter Table - Modify Column Query
    "SQL Alter Table Modify Column": {
        "prefix": "sqlmodifycolumn",
        "body": [
            "ALTER TABLE ${1:table_name}",
            "MODIFY COLUMN ${2:column_name} ${3:datatype};"
        ],
        "description": "SQL Query to modify a column's data type in a table"
    },

    // SQL Create Table Query
    "SQL Create Table Query": {
        "prefix": "sqlcreatetable",
        "body": [
            "CREATE TABLE ${1:table_name} (",
            "    ${2:column1} ${3:datatype1} ${4:constraints},",
            "    ${5:column2} ${6:datatype2} ${7:constraints}",
            ");"
        ],
        "description": "SQL Create Table Query to create a new table"
    },

    // SQL Drop Table Query
    "SQL Drop Table Query": {
        "prefix": "sqldroptable",
        "body": [
            "DROP TABLE IF EXISTS ${1:table_name};"
        ],
        "description": "SQL Drop Table Query to delete a table"
    },

    // SQL Join Multiple Tables
    "SQL Join Multiple Tables": {
        "prefix": "sqljointables",
        "body": [
            "SELECT ${1:table1}.${2:column1}, ${3:table2}.${4:column2}",
            "FROM ${1:table1}",
            "INNER JOIN ${3:table2} ON ${1:table1}.${5:common_column} = ${3:table2}.${5:common_column}",
            "INNER JOIN ${6:table3} ON ${1:table1}.${7:common_column} = ${6:table3}.${7:common_column};"
        ],
        "description": "SQL Query to join multiple tables"
    },

    // SQL Union Query
    "SQL Union Query": {
        "prefix": "sqlunion",
        "body": [
            "SELECT ${1:column_name} FROM ${2:table_name1}",
            "UNION",
            "SELECT ${1:column_name} FROM ${3:table_name2};"
        ],
        "description": "SQL Union Query to combine results from two tables"
    },

    // SQL Create Index Query
    "SQL Create Index Query": {
        "prefix": "sqlcreateindex",
        "body": [
            "CREATE INDEX ${1:index_name}",
            "ON ${2:table_name}(${3:column_name});"
        ],
        "description": "SQL Create Index Query"
    },

    // SQL Drop Index Query
    "SQL Drop Index Query": {
        "prefix": "sqldropindex",
        "body": [
            "DROP INDEX ${1:index_name} ON ${2:table_name};"
        ],
        "description": "SQL Drop Index Query"
    }
}
