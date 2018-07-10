<?php
/**
 * Created by PhpStorm.
 * User: rocket
 * Date: 10.07.18
 * Time: 10:25
 */

function getCmsNavigation() {
    $files = glob(CMSPATH . '*.inc.php');

    $html = '<ul>';

    foreach ($files as $file) {
        $replace = str_replace(
            [
                CMSPATH,
                '.inc.php'
            ],
            '',
            $file
        );

        $link = '/cms/?page=' . $replace;
        $display = ucfirst($replace);

        $html .= '<li><a href="' . $link . '">' . $display . '</a></li>';
    }

    $html .= '<ul>';

    return $html;
}

function getContent($path = CMSPATH) {

    if(!isset($_GET['page'])) {
        $pageName = 'start';
    } else {
        $pageName = $_GET['page'];
    }

    $pathToFile = $path . $pageName . '.inc.php';

    if(is_file($pathToFile)) {
        require_once $pathToFile;
    } else {
        require_once $path . '404.php';
    }

    return $content;
}