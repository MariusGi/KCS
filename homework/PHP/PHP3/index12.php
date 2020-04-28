<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 12 | Exercise</title>
</head>
<body>
<?php
     if(isset($_GET['first_name']) && isset($_GET['last_name']))
     {
         printFullName($_GET['first_name'], $_GET['last_name']);
     }
     
     function printFullName(string $firstName, string $lastName)
     {
         echo 'First name: ' . $firstName . '<br>Last name: ' . $lastName;
     }
?>
    <form action="<?php $_PHP_; ?>", method="GET">
        <input type="text" name="first_name" placeholder="First name">
        <input type="text" name="last_name" placeholder="Last name">
        <input type="submit">
    </form>
</body>
</html>
