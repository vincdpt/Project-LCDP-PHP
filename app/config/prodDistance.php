<?php

// Doctrine (db)
// connexion serveur distant
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'microcms',
    'user'     => 'root',
    'password' => 'root',
);
