<<?php
$localhost= false;
if($_SERVER['SERVER_ADDR'] === '127.0.0.1'){
    $url = 'http://Zavrsni_rad_2021.xyz/';
    $localhost= true;

}

return [
    'localhost' => $localhost,
    'siteTitle' => 'Farm shop',
    'url' => 'http://Zavrsni_rad_2021.xyz/',
    'database' => [
        'server' => 'localhost',
        'name' => 'Zavrsni_rad_2021',
        'user' => 'Filip-J',
        'password' => 't84durft1994@'
    ]
];
