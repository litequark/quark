<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <title>Form Action</title>
    </head>

    <body>
        <h1>Form Action Handling</h1>
        <p>Thanks for your submission.</p>
        <p>On the date <?php echo $_POST["date"];?>, you created the following reminder:</p>
        <p><?php echo $_POST["task"];?></p>
    </body>
</html>