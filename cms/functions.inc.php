<?php
/**
 * Created by PhpStorm.
 * User: rocket
 * Date: 10.07.18
 * Time: 10:25
 */

function getCmsNavigation() {
    // Connect to database db1
    $pages = getPages();

    $html = '<ul>';

    foreach ($pages as $page) {
        $title = $page->title;
        $id = $page->id;

        $link = '/cms/?page=' . $id;

        $html .= '<li><a href="' . $link . '">' . $title . '</a></li>';
    }

    $html .= '<ul>';

    return $html;
}

/**
 * @return mixed
 */
function getPages()
{
    $db = new my_db(DB_MAIN);
    $pages = $db->fetchAll('SELECT * FROM pages');
    return $pages;
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
    } elseif($pageId === 'admin' && isLoginState() === true) {
        require_once $path . 'admin.inc.php';
    } else {
        require_once $path . '404.php';
    }

    return $content;
}

function getLogin() {
    if(isset($_GET['logout'])) {
        unset($_SESSION['login']);
    }

    if (isset($_POST['username'])) {
        $username = 'admin';
        $password = 'password';

        if($_POST['username'] === $username && $_POST['password'] === $password) {
            $_SESSION['login'] = true;
        }
    }

    $html = '<form action="" method="post">';
    $html .= '<div><input type="text" name="username" id="username"></div>';
    $html .= '<div><input type="password" name="password" id="password"></div>';
    $html .= '<div><input type="submit" value="Login"></div>';
    $html .= '</form>';

    if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
        $html = 'Willkommen mein Freund <a href="/cms/?logout=1">Logout</a>';
        $html .= '<div><a href="/cms/?page=admin">Admin</a></div>';
    }

    return $html;
}

function getAdminPage() {
    if(!isLoginState()) {
        return 'Nicht erlaubt';
    }

    if (isset($_POST['title'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $headline = $_POST['headline'];
        $bodytext = $_POST['bodytext'];

        $db = new my_db(DB_MAIN);
        $sql = "update `pages` SET `title`='$title', `headline`='$headline', `bodytext`='$bodytext' where `id`=$id;";
        $db->fetchAll($sql);
    }

    $pages = getPages();

    $html = '<div>';
    foreach ($pages as $page) {
        $html .= '<form name="form-" action="" method="post">';
        $html .= '<label for="title">Title</label>';
        $html .= '<input type="text" name="title" id="title" value="' . $page->title . '">';
        $html .= '<label for="headline">Headline</label>';
        $html .= '<input type="text" name="headline" id="headline" value="' . $page->headline . '">';
        $html .= '<label for="bodytext">Bodytext</label>';
        $html .= '<input type="text" name="bodytext" id="bodytext" value="' . $page->bodytext . '">';
        $html .= '<input type="hidden" name="id" id="id" value="' . $page->id . '">';
        $html .= '<input type="submit" value="edit">';
        $html .= '</form>';
    }
    $html .= '</div>';

    // Pages foreach formular

    return $html;
}

function isLoginState() {
    if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
        return true;
    }

    return false;
}














