<nav>
    <div class="row text-align-center justify-content-center">
        <div class="col-4 col-md-3 col-lg-2">
            <a href="<?php if ($pageTitle === 'Scoreboard'): echo './index.php'; else: echo '#'; endif; ?>" title="Game">Game</a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="<?php if ($pageTitle === 'Game'): echo './scoreboard.php'; else: echo '#'; endif; ?>" class="" title="Scoreboard">Scoreboard</a>
        </div>
    </div>
</nav>