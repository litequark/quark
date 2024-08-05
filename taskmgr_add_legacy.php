<!-- This backup file should NOT be used normally. -->


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <title>Data submission</title>
    </head>

    <body>
        <?php
            function validate_input($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $postdate = validate_input($_POST["date"]);
                // echo $postdate;
                $posttask = validate_input($_POST["task"]);
            }
        ?>
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
            echo "<p>数据库已连接</p>";

            // $postdate = $_POST["date"];
            // echo $postdate;
            // $posttask = $_POST["task"];

            $sql_insert = "INSERT INTO task VALUES (null, '$postdate', '$posttask');";

            if ($conn->query($sql_insert) === true) {
                echo "<p>Insert row: success</p>";
            } else {
                echo "<p>Insert row: failure</p>";
            }

            // data_insert($_POST["date"], $_POST["task"]);
        ?>
    </body>
</html>