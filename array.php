<?php
$info = array('Kaffee', 'braun', 'Koffein');

// Auflisten aller Variablen
list($drink, $color, $power) = $info;
echo "$drink ist $color und $power macht es zu etwas besonderem.\n";

// Ein paar davon auflisten
list($drink, , $power) = $info;
echo "$drink hat $power.\n";

// Oder nur die dritte ausgeben
list( , , $power) = $info;
echo "Ich brauche $power!\n";

// list() funktioniert nicht mit Zeichenketten
$test = '123456';
var_dump($test[2]);

$a = true;

if ($a === 1) {
    echo 'gibts das?';
}

$groesse = "groß";
$var_array = [
    "farbe" => "blau",
    "groesse" => "mittel",
    "form" => "Kugel"
];

extract($var_array, EXTR_PREFIX_SAME, "wddx");

echo "$farbe, $groesse, $form, $wddx_groesse\n";

echo "\n\r";
echo '<br>';
extract($var_array, EXTR_OVERWRITE);

echo "$farbe, $groesse, $form, $wddx_groesse\n";