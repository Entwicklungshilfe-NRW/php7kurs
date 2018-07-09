<?php
    $navigation = [
        'start',
        'Über mich',
        'Impressum'
    ];

    $footer = [
            'Impressum',
            'FB',
            'Instagram',
            'YT'
    ];

    function getNavigation($navigation) {
        $html  = '<ul>';

        foreach ($navigation as $item) {
            $html .= '<li>' . $item . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }


?>

<body>
    <nav>
        <?= getNavigation($navigation); ?>
    </nav>
    <div id="content">
        Herzlich willkommen
    </div>
    <div id="footer">
        <?= getNavigation($footer); ?>
    </div>
</body>