<?php
    include './includes/autoloader.inc.php';
    
    $pageTitle = 'Scoreboard';

    $query = new Query();
    $stmt = $query->getTopScores(20);
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once './assets/partials/header.php' ?>

<body>
    <div class="container">
        
        <?php include_once './assets/partials/navbar.php' ?>
        
        <div class="row text-align-center justify-content-center align-items-center">
            <div class="col-12">
                <h1>Scoreboard</h1>
                <h3>Top 20 rankings</h3>
            </div>
            
            <?php
            $usernames = '';
            $scores = '';
            
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usernames .= "<p>{$result['username']}</p>";
                $scores .= "<p>{$result['score']}</p>";
            }
            ?>
            
            <div class="col-1 scoreboard-usernames">
                <p>Username</p>
                
                <?php echo $usernames; ?>
                
            </div>
            <div class="col-1 scoreboard-scores">
                <p>Score</p>

                <?php echo $scores; ?>
                
            </div>
        </div>
    </div>

<?php include_once './assets/partials/footer.php' ?>
