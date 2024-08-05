<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <title>PHP Test Page</title>
    </head>

    <body>
        <?php
            echo '<h1>PHP also works!</h1>';
            echo '<p>Hello world!</p>';
            echo '<p>This indicates that PHP is also ready for use! <strong>It also works!</strong></p>';
        ?>
        <p>All the title and paragraphs above are echoed from PHP codes.</p>
        <p>Go to <a href="database.php">Database Test Page</a>.</p>

        <?php
            /* $arr = [false, false, false, false, false];
            // $arr = [];
            $result = array_reduce($arr, function($carry, $item) {
                if ($item == true) {
                    return $carry + 1;
                } else {
                    return $carry;
                }
            }, 0);

            if ($result == 0) {
                echo "<p>全是false</p>";
            } else {
                echo "<p>含有true</p>";
            } */
        ?>

        <?php
            function clean_input($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }
            $a = clean_input("");
            echo empty($a);
        ?>
    </body>
</html>