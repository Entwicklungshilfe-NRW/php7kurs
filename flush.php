<?php

if (ob_get_level() == 0) ob_start();

for ($i = 1; $i<=10; $i++){

    $percent = 10 * $i;

    echo "<br> Line to show. Percent: $percent";
    echo str_pad('',4096)."\n";

    ob_flush();
    flush();
    sleep(2);
}
