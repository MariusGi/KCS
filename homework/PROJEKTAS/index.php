<?php
    include './includes/autoloader.inc.php';

    if (isset($_POST['username']))
    {
        $userForm = new UserForm();
        $isValid = $userForm->validate($_POST['username']);
        
        // username or ip address is invalid
        if (!$isValid) return false;

        $queryData = $userForm->returnQueryDataIfExistsInDb();
        
        // username does not exist
        // new username can be created
        if (!$queryData) return false;

        $isUsernameLinkedToIp = $userForm->checkIfUsernameLinkedToIp($queryData);
        
        // set cookie and login user
        if ($isUsernameLinkedToIp);

        // display error that username already exists
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link href="./themes/numerico/assets/css/reset.css" rel="stylesheet">
    <link href="./themes/numerico/assets/css/main.css" rel="stylesheet">
    <link href="./themes/numerico/assets/css/index.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- <div class="row text-align-center justify-content-center">
            <div class="col-4 col-md-3 col-lg-2">
                <a href="index.html" class="btn btn-success" title="Home">Home</a>
            </div>
            <div class="col-4 col-md-3 col-lg-2">
                <a href="#" title="Game">Game</a>
            </div>
            <div class="col-4 col-md-3 col-lg-2">
                <a href="#" class="btn btn-danger" title="Scoreboard" onclick="alert('Sorry, scoreboard currently disabled');">Scoreboard</a>
            </div>
        </div> -->
        <div class="row text-align-center justify-content-center align-items-center">
            <div class="col-12">
                <h1>Speedy calculation game</h1>
                <input type="hidden" id="end-time-indicator"></input>
                <div class="game-rules-wrapper">
                    <p>You will have 30 seconds to show your skills.</p>
                    <p>Each correct awnser grants you additional 3 seconds.</p>
                    <h4>Please enter your username</h4>
                    <div>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="text" name="username">
                            <input type="submit" value="Submit" class="btn btn-success">
                        </form>
                    </div>
                    <h4 class="hidden">Press start button to start the game!</h4>
                    <h4 class="d-none last-score-heading">Your last score: <span id="last-score-value"></span></h4>
                    <button id="start-game" class="btn btn-success hidden">Start game</button>
                </div>
            </div>
        </div>
        <div class="row exercise-wrapper text-align-center justify-content-center align-items-center">
            <div class="col-6 col-sm-3 game-clock-wrapper pos-relative hidden">
                <img src="./assets/img/clock.png" alt="clock" title="clock" id="game-clock-img">
                <span class="game-clock-value"></span>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 exercise-content-wrapper hidden">
                <span id="math-problem-first-number"></span>
                <span id="math-problem-operation"></span>
                <span id="math-problem-second-number"></span>
                <span id="math-problem-equals-sign">=</span>
                <input type="number" id="math-problem-result">
                <button id="math-problem-submit" class="btn btn-success" tabindex="0">Submit</button>
            </div>
            <div class="col-6 col-sm-3 game-score-wrapper pos-relative hidden">
                <img src="./assets/img/vector-dartboard-1966525_960_720.png" alt="scoreboard" title="scoreboard" id="game-score-image">
                <span class="game-score-value">1</span>
            </div>
        </div>
    </div>

    <script src="./themes/numerico/assets/js/app.js"></script>
</body>
</html>
