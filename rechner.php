<?php

require_once 'rechnerfunc.inc.php';

$fields = [
    'zahl1',
    'zahl2',
    'zahl3',
    'zahl4'
];

?>

<html>
    <head>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
    <?= getFormular($fields); ?>
    <?= calculate($fields); ?>
    </body>
</html>
