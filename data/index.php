<?php
    session_start();
    require_once("./autoload.php");

    $game = new GameClass();
    // $game->createFighters();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Arène</title>
    </head>
    <body>
        <main>
            <?php
                // $game->fight();
            ?>
            <a href="index.php?state=reset">Reset</a>
        </main>
    </body>
</html>