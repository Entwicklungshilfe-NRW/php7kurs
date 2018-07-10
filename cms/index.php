<?php

require_once 'config.ing.php';
require_once 'functions.inc.php';

$content = getContent();

?>
<html>
    <head>
        <title><?= $content['title'] ?></title>
    </head>
    <body>
        <nav>
            <?= getCmsNavigation(); ?>
        </nav>
        <div id="content">
            <h1><?= $content['content']['headline'] ?></h1>
            <p><?= $content['content']['bodytext'] ?></p>
        </div>
    </body>
</html>