<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <title>To-do</title>
    </head>

    <body>
        <h1>To-do list</h1>
        <p>代码重构中，删除、修改功能暂未实现</p>
        <?php
            require "_credential.php";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database, $port);

            function data_insert ($insert_date, $insert_content) { // 插入数据的函数
                global $conn;
                $sql_insert = "INSERT INTO task VALUES (null, $insert_date, $insert_content);";

                if ($conn->query($sql_insert) === true) {
                    echo "<p>Insert row: success</p>";
                } else {
                    echo "<p>Insert row: failure</p>";
                }
            }  // 为什么这里要分号？？答：annoymous function. No name given.
        ?>

        <?php
            // Check connection
            if ($conn->connect_error) {
                echo "<p>Connection failed.</p>";
                die("Connection failed: " . $conn->connect_error);
            }
            echo "<p>数据库已连接</p>";
        ?>

        <h2>Add New Data</h2>
        <p>* Required field</p>

        <?php
            $date_error = $task_error = "";
            $postresult = "";
        
            function validate_input($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") { // 有POST才提交
                $postdate = $posttask = ""; // 增加或修改
                if ($_POST["date"] == null && $_POST["task"] == null) {
                    # del code

                } elseif ($_POST["id"] != null && $_POST["date"] != null && $_POST["task"] != null) {
                    # modify code

                } elseif ($_POST["date"] != null && $_POST["task"] != null) {
                    # add code

                    if (empty($_POST["date"])) {
                    $date_error = "Date cannot be empty";
                    } else {
                    $postdate = validate_input($_POST["date"]);
                    // echo $postdate;
                    }
                    
                    if (empty($_POST["task"])) {
                        $task_error = "Task cannot be empty";
                    } else {
                        $posttask = validate_input($_POST["task"]);
                    }
                    
                    $sql_insert = "INSERT INTO task VALUES (null, '$postdate', '$posttask');";

                    if (($postdate != "") && ($posttask != "")){
                        if ($conn->query($sql_insert) === true) {  // 发送query并验证
                            $postresult = "<p>Insert row: success</p>";
                            // echo "postdate = $postdate";
                            // echo '_POST[\"date\"] = ' . $_POST['date'];
                        } else {
                            $postresult = "<p>Insert row: failure</p>";
                        }
                        // $_POST[] = null;
                    }

                }
            }
        ?>

        <form action="taskmgr_add.php" method="post">
            <label for="date">Date:</label><br>
            <input type="date" name="date" id="date" max="2999-12-31" required>
            <span class="error">* <?php echo $date_error;?></span>
            <br><br>

            <label for="task">You want to do:</label><br>
            <textarea name="task" id="task" required></textarea>
            <span class="error">* <?php echo $task_error;?></span>
            <br><br>

            <input type="submit" value="Confirm & Submit">
        </form>

        <?php
            echo "$postresult";
        ?>

        <h2>View Data</h2>
        
        <?php
            $del_button_1 = 
            "<form>
                <input type='number' name='id' id='id' value=";

            $del_button_2 = 
                " hidden>
                <input type='submit' value='Delete'>
            </form>";
            // echo $del_button;
        ?>

        <?php
            $sql_select = "SELECT * FROM task;";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"] . " - date: " . $row["added"] . " - task: " . $row["task"] .
                    $del_button_1 . $row["id"] . $del_button_2 . "<br>";
                }
            } else {
                echo "No result found.";
            }

            // $conn->close();
            // Connection automatically closes at the end of script. 
            // We can also close it manually.
        ?>
        
        <br>

        
    </body>
</html>