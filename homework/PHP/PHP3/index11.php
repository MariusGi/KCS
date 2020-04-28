<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 11 | Exercise</title>
</head>
<body>
    <?php
        if(isset($_GET['rectangle_height']) && isset($_GET['rectangle_width']))
        {
            printRectangleArea($_GET['rectangle_height'], $_GET['rectangle_width']);
        }
        
        function printRectangleArea(int $rectangleHeight, int $rectangleWidth)
        {
            $area = $rectangleHeight * $rectangleWidth;
            echo 'Rectangle area: ' . $area;
        }
    ?>
    <form action="<?php $_PHP_; ?>", method="GET">
        <input type="number" name="rectangle_height">
        <input type="number" name="rectangle_width">
        <input type="submit">
    </form>
</body>
</html>
