<?php
$menu = [
    'categories' => [
        'name' => 'категории',
        'pic'  => '...',
    ],
    'products' => [
        'name' => 'товары',
    ],
];

echo '<ul class="adminMenu">';
foreach ($menu as $url => $param) {
    echo '<li><a href="' . $url . '.php">' . $param['name'] . '</a></li>';
}
echo '</ul>';
