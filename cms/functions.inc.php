<?php
/**
 * Created by PhpStorm.
 * User: rocket
 * Date: 10.07.18
 * Time: 10:25
 */

function getCmsNavigation() {
    // Connect to database db1
    $db = new my_db(DB_MAIN);

    $rows = $db->fetchAll('SELECT * FROM pages');

    $html = '<ul>';

    foreach ($rows as $row) {
        $title = $row->title;
        $id = $row->id;

        $link = '/cms/?page=' . $id;

        $html .= '<li><a href="' . $link . '">' . $title . '</a></li>';
    }

    $html .= '<ul>';

    return $html;
}

function getContent($path = CMSPATH) {

    $pageId = '1';
    if(isset($_GET['page'])){
        $pageId = $_GET['page'];
    }

    $db = new my_db(DB_MAIN);

    $page = $db->fetchAll('SELECT * FROM pages WHERE id=' . $pageId);

    // Wenn Datensatz vorhanden
    if(!empty($page)) {
        $dbContent = $page[0];

        $content = [
            'title' => $dbContent->title,
            'content' => [
                'headline' => $dbContent->headline,
                'bodytext' => $dbContent->bodytext
            ]
        ];
    } else {
        require_once $path . '404.php';
    }

    return $content;
}

function getLogin() {
    if(isset($_GET['logout'])) {
        unset($_SESSION['login']);
    }

    if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
        return 'Willkommen mein Freund <a href="/cms/?logout=1">Logout</a>';
    }

    $html = '<form action="" method="post">';
    $html .= '<div><input type="text" name="username" id="username"></div>';
    $html .= '<div><input type="password" name="password" id="password"></div>';
    $html .= '<div><input type="submit" value="Login"></div>';
    $html .= '</form>';

    if (isset($_POST['username'])) {
        $username = 'admin';
        $password = 'password';

        if($_POST['username'] === $username && $_POST['password'] === $password) {
            $_SESSION['login'] = true;
        }
    }


    return $html;
}














