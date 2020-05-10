<?php
    include './includes/autoloader.inc.php';

    $query = new Query();
    $stmt = $query->getTopScores(20);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    <link href="./assets/css/reset.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <link href="./assets/css/index.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row text-align-center justify-content-center">
            <div class="col-4 col-md-3 col-lg-2">
                <a href="./index.php" title="Game">Game</a>
            </div>
            <div class="col-4 col-md-3 col-lg-2">
                <a href="#" class="" title="Scoreboard">Scoreboard</a>
            </div>
        </div>
        <h2>Top 20 rankings</h2>
        <table>
        <tr>
            <th>Username</th>
            <th>Score</th>
        </tr>

        <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

            <tr>
                <td class="pr-20"><?php echo $result['username']; ?></td>
                <td><?php echo $result['score']; ?></td>
            </tr>

        <?php endwhile; ?>

        </table>
    </div>
</body>
</html>