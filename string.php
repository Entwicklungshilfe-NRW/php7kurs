<?php

// ä,ö,ü,ß -> ae,oe,ue,ss

$umlaute = [
    'ä' => 'ae',
    'ö' => 'oe',
    'ü' => 'ue',
    'ß' => 'ss'
];

$woerter = [
    'Überraschung',
    'Spaß',
    'Spaßvögel',
    'Später können wir das dann alles',
    'können'
];

function umlauteReplacer($value, $umlaute) {
    foreach ($umlaute as $umlaut => $replacement) {
        $value = str_replace($umlaut, $replacement, $value);

        $upperReplacement = mb_strtoupper(substr($replacement, 0, 1)) . substr($replacement, 1);
        $value = str_replace(mb_strtoupper($umlaut), $upperReplacement, $value);
    }

    return $value;
}

foreach ($woerter as $word) {
    echo $word . ' -> ' . umlauteReplacer($word, $umlaute) . '<br>';
}