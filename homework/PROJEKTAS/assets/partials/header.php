<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="./assets/css/reset.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    
    <?php if ($pageTitle === 'Game'): ?>
    
        <link href="./assets/css/index.css" rel="stylesheet"> 

    <?php endif; ?>
    
    <?php if ($pageTitle === 'Scoreboard'): ?>
    
        <link href="./assets/css/scoreboard.css" rel="stylesheet"> 

    <?php endif; ?>

</head>