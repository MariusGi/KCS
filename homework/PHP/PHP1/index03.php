<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ND | PHP3</title>
</head>
<body>
    <?php
        $x = 10;
        $y = 7;
        $z = $x + $y;
        
        echo $x . ' + ' . $y . ' = ' . $z . '<br>';
        $z = $x - $y;
        echo $x . ' - ' . $y . ' = ' . $z . '<br>';
        $z = $x * $y;
        echo $x . ' * ' . $y . ' = ' . $z . '<br>';
        $z = round($x / $y, 1);
        $varToConsole = $z;
        echo $x . ' / ' . $y . ' = ' . $z . '<br>';
        $z = 10 % 7;
        echo $x . ' % ' . $y . ' = ' . $z;
    ?>
    <script>
        console.log(<?php echo $varToConsole; ?>);
    </script>
</body>
</html>