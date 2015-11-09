<?php

/**
 * Project's settings.
 */

$app['cache.path'] = __DIR__ . '/../cache';

$app['twig.options.cache'] = $app['cache.path'] . '/twig';

$app['db.options'] = [
    'driver'   => 'pdo_mysql',
    'host'     => OPENSHIFT_MYSQL_DB_HOST,
    'port'     => OPENSHIFT_MYSQL_DB_PORT,
    'dbname'   => 'chasort',
    'user'     => OPENSHIFT_MYSQL_DB_USERNAME,
    'password' => OPENSHIFT_MYSQL_DB_PASSWORD,
    'charset'  => 'UTF8'
];
