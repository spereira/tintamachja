<?php

// Doctrine (db)
$app['db.options'] = array(
  'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => 'tintamchja',
    'user'     => 'tinta_user',
    'password' => 'secret'
);

// enable the debug mode
$app['debug'] = true;