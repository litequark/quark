<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <title>Data submission</title>
    </head>

    <body>
        <?php
            require "_credential.php";
            require "_clean_input.php";

            $postdate = $posttask = "";

            // 错误码
            /*
                错误码的类型：
                no_post
                date_empty
                task_empty
                bad_connection
                query_failure
            */
            $error = [
                "no_post" => false,
                "date_empty" => false,
                "task_empty" => false,
                "bad_connection" => false,
                "query_failure" => false,
            ];

            function noError () {
                global $error;

                $err_true = array_reduce($error, function($carry, $item) {
                    if ($item == true) {
                        $carry = $carry + 1;
                    }

                    return $carry;
                }, 0);

                if ($err_true == 0) {
                    return true;
                } else {
                    return false;
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $postdate = clean_input($_POST["date"]);
                $posttask = clean_input($_POST["task"]);
                /* echo "<script>alert('";
                echo empty($posttask);
                echo "');</script>"; */

                if (empty($postdate)) {
                    $error["date_empty"] = true;
                }

                if (empty($posttask)) {
                    $error["task_empty"] = true;
                    /* echo "<script>alert('";
                    echo $error["task_empty"];
                    echo "');</script>"; */
                }

                if (noError() == true) {
                    $sql = "INSERT INTO task VALUES (null, '$postdate', '$posttask');";
                    $conn = new mysqli($servername, $username, $password, $database, $port);
                    if ($conn->connect_error) {
                        $error["bad_connection"] = true;
                    } elseif ($conn->query($sql) === false) {
                        $error["insert_failure"] = true;
                    }
                }
            } else {
                $error["no_post"] = true;
            }

            // give out alert message
            echo "<script>alert('";
            if ($error["no_post"] == true) {
                echo "未找到POST数据，请直接在To-do页面提交表单;";
            } else {
                if ($error["date_empty"] == true) {
                    echo "请填写日期;";
                }
                if ($error["task_empty"] == true) {
                    echo "请填写事项;";
                }
                
                if ($error["date_empty"] == false && $error["task_empty"] == false) {
                    if ($error["bad_connection"] == true) {
                        echo "无法连接至数据库;";
                    } elseif ($error["query_failure"] == true) {
                        echo "SQL语句执行错误;";
                    } else {
                        echo "添加记录成功;";
                        // echo "date = $postdate;";
                        // echo "task = $posttask;";
                    }
                }
            }
            echo "');";

            if (noError() == true) {
                echo "window.location.href = 'taskmgr.php';";
            } else {
                echo "history.back();";
            }
            echo "</script>";
        ?>
        <!-- <script>
            history.back();
        </script> -->
    </body>
</html>