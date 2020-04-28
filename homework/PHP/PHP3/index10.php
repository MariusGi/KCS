<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 10 | Exercise</title>
</head>
<body>
    <?php
        printRectangleArea(10.5, 20.5);
    
        function printRectangleArea(float $rectangleHeight, float $rectangleWidth)
        {
            $area = $rectangleHeight * $rectangleWidth;
            echo $area;
        }
    ?>
</body>
</html>
