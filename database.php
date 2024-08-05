<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device.height, initial-scale=1.0">
        <title>Database Test Page</title>
    </head>

    <body>
        <h1>Database Test Page</h1>
        <p>This page, we are testing PHP to Database connection.</p>
        <p>If the connection succeeds, a message should appear below.</p>
        <?php
            // Store credentials
            $servername = 'localhost';
            $username = 'user';
            $password = 'user';
            $database = 'task_manager';
            $port = 3306;
            

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database, $port);

            
            // Check connection
            if ($conn->connect_error) {
                echo "<p>Connection failed.</p>";
                die("Connection failed: " . $conn->connect_error);
            }
            echo "<p>Connected successfully!</p>";

            /* $sql = "INSERT INTO task VALUES (null, '2024-08-01', '摸鱼');";

            if ($conn->query($sql) === true) {
                echo "<p>Insert row: success</p>";
            } else {
                echo "<p>Insert row: failure</p>";
            } */

            $sql = "SELECT * FROM task;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"] . " - date: " . $row["added"] . " - task: " . $row["task"] . "<br>";
                }
            } else {
                echo "No result found.";
            }

            $conn->close();
            // Connection automatically closes at the end of script. 
            // We can also close it manually.
        ?>
    </body>
</html>