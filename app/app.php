<?php

/**
 * Application's settings.
 */

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;


$app->register(new SessionServiceProvider());

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_mysql',
        'host'     => getenv('OPENSHIFT_MYSQL_DB_HOST'),
        'port'     => getenv('OPENSHIFT_MYSQL_DB_PORT'),
        'dbname'   => 'chasort',
        'user'     => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
        'password' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
        'charset'  => 'UTF8'
    ]
]);

$app->register(
    new TwigServiceProvider(),
    [
        'twig.options' => [
            'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
            'strict_variables' => true,
        ]
    ]
);

$app->register(
    new MonologServiceProvider(),
    ['monolog.logfile' => __DIR__ . '/../logs/silex_app.log']
);

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

return $app;
