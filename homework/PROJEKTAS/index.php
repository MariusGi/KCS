<?php
    session_start();
    
    include './includes/autoloader.inc.php';
    
    $pageTitle = 'Game';
   
    if (isset($_SESSION['message']))
    {
        switch($_SESSION['message'])
        {
            case 'reuse username':
                Helper::flashMessage("Username already exists for this ip address. Automatically selected {$_COOKIE['username']}");
                unset($_SESSION["message"]);
                session_destroy();
                break;
            case 'create username':
                Helper::flashMessage('User has been successfully created !');
                unset($_SESSION["message"]);
                session_destroy();
                break;
            case 'unable to create username':
                Helper::flashMessage('Unable to create new user. Please try again.');
                unset($_SESSION["message"]);
                session_destroy();
                break;
            case 'username already exists':
                Helper::flashMessage('Username already exists. Please choose different username.');
                unset($_SESSION["message"]);
                session_destroy();
                break;
        }       
    }
    
    if (isset($_POST['username']))
    {
        $userForm = new UserForm();
        $isValid = $userForm->validate($_POST['username']);
        
        // username or ip address is invalid
        if (!$isValid)
        {
            Helper::flashMessage('Username is invalid. Please try again.');
            goto exitIf;
        } 

        $queryData = $userForm->returnQueryDataIfExistsInDb();

        // username does not exist
        // new username can be created
        if (!$queryData)
        {
            $query = new Query();
            $query->addUserToDb('users', $_POST['username']);

            if ($query)
            {
                setcookie('username', $_POST['username'], time() + (86400 * 365), '/');
                $_SESSION["message"] = 'create username';
                Helper::redirect('./');
                goto exitIf; 
            }
            else
            {
                $_SESSION["message"] = 'unable to create username';
                Helper::redirect('./');
                goto exitIf;
            }
        }

        $isUsernameLinkedToIp = $userForm->checkIfUsernameLinkedToIp($queryData);

        // set cookie as username is linked to current ip address
        if ($isUsernameLinkedToIp)
        {
            setcookie('username', $queryData['username'], time() + (86400 * 365), '/');
            $_SESSION["message"] = 'reuse username';
            Helper::redirect('./');
            goto exitIf;
        }
        
        $_SESSION["message"] = 'username already exists';
        Helper::redirect('./');
        goto exitIf;
    }
    

    $xhrRequest = file_get_contents('php://input');

    if (!empty($xhrRequest))
    {
        $object = json_decode($xhrRequest, true);
        
        if (isset($object['score'])) 
        {
        
            $query = new Query();
            $score = $query->checkIfScoreExistsForUser($object['score'], $_COOKIE['username']);

            if ($score === false)
            {
                $query->addNewScore($object['score']);
                // messages does not work here
                // Helper::flashMessage('Your last score has been recorded.');
                goto exitIf;
            }
            
            // Current score is lower than top score of an user.
            if ($object['score'] < $score)
            {
                goto exitIf;
            }
            
            // New record score.
            $query->updateNewScore($object['score']);
            // messages does not work here
            // Helper::flashMessage('Congratulations. New high score has been added !');
        }
    }
    
exitIf:

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once './assets/partials/header.php' ?>

<body>
    <div class="container">
        
        <?php include_once './assets/partials/navbar.php' ?>
    
        <div class="row text-align-center justify-content-center align-items-center">
            <div class="col-12">
                <h1>Speedy calculation game</h1>
                <input type="hidden" id="end-time-indicator"></input>
                <div class="game-rules-wrapper">
                    <p>You will have 30 seconds to show your skills.</p>
                    <p>Each correct awnser grants you additional 3 seconds.</p>

                    <?php if (!isset($_COOKIE['username'])) : ?>

                        <h4>Please enter your username</h4>
                        <div>
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="text" name="username">
                                <input type="submit" value="Submit" class="btn btn-success">
                            </form>
                        </div>

                    <?php else: ?>

                        <h4>Press start button to start the game!</h4>
                        <h4 class="d-none last-score-heading">Your last score: <span id="last-score-value"></span></h4>
                        <button id="start-game" class="btn btn-success">Start game</button>

                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="row exercise-wrapper text-align-center justify-content-center align-items-center">
            <div class="col-6 col-sm-3 game-clock-wrapper pos-relative hidden">
                <img src="./assets/img/purzen_Clock_face_web.png" alt="clock" title="clock" id="game-clock-img">
                <span class="game-clock-value"></span>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 exercise-content-wrapper hidden">
                <div class="math-problem-phenom-wrapper d-inline-block">
                    <span id="math-problem-first-number"></span>
                    <span id="math-problem-operation"></span>
                    <span id="math-problem-second-number"></span>
                </div>
                <span id="math-problem-equals-sign">=</span>
                <input type="number" id="math-problem-result">
                <button id="math-problem-submit" class="btn btn-success" tabindex="0">Submit</button>
            </div>
            <div class="col-6 col-sm-3 game-score-wrapper pos-relative hidden">
                <img src="./assets/img/vector-dartboard-1966525_960_720.png" alt="scoreboard" title="scoreboard" id="game-score-image">
                <span class="game-score-value"></span>
            </div>
        </div>
    </div>

<?php include_once './assets/partials/footer.php' ?>
