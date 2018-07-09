<?php

function getSumOfAllFields($fields) {
    $sum = '';

    if(!empty($_POST)) {
        foreach ($fields as $field) {
            $sum += $_POST[$field];
        }
    }

    return $sum;
}

function getMultiOfAllFields($fields) {
    $sum = 1;

    if(!empty($_POST)) {
        foreach ($fields as $field) {
            $sum *= $_POST[$field];
        }
    }

    return $sum;
}

function calculate($fields) {
    if(!empty($_POST)) {
        if($_POST['operator'] === 'add') {
            return getSumOfAllFields($fields);
        }

        if($_POST['operator'] === 'multi') {
            return getMultiOfAllFields($fields);
        }

        return 'no valid operator';
    }
}

function validate($value) {
    if (!empty($_POST)) {
        $check = $_POST[$value];

        if($check === '') {
            return 'Leerer Wert';
        }

        if(!is_numeric($check)) {
            return 'Keine Zahl';
        }
    }

    return true;
}

function getFormular($fields) {
    $html = '<form action="rechner.php" method="post">';
    foreach ($fields as $field) {
        $validate = validate($field);

        if($validate !== true) {
            $html .= '<div class="error">' . $validate . '</div>';
        }


        $html .= '<input type="text" name="' . $field . '" id="' . $field .'">';
    }

    $html .= '<input type="radio" name="operator" value="add" checked="checked"> Add';
    $html .= '<input type="radio" name="operator" value="multi"> Multi';
    $html .= '<input type="submit" value="addieren">';
    $html .= '</form>';
    return $html;
}