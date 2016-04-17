<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new VeryGoodTrip\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Register services
$app['dao.category'] = $app->share(function ($app) {
   return new VeryGoodTrip\DAO\CategoryDAO($app['db']);
});

$app['dao.trip'] = $app->share(function ($app) {
    $tripDAO = new VeryGoodTrip\DAO\TripDAO($app['db']);
    $tripDAO->setCategoryDAO($app['dao.category']);
    return $tripDAO;
});
$app['dao.user'] = $app->share(function ($app) {
    return new VeryGoodTrip\DAO\UserDAO($app['db']);
});

$app['dao.cart'] = $app->share(function ($app)
{
    $cartDAO = new VeryGoodTrip\DAO\CartDAO($app['db']);
    $cartDAO->setTripDAO($app['dao.trip']);
    $cartDAO->setUserDAO($app['dao.user']);
    return $cartDAO;
});

$app['dao.review'] = $app->share(function ($app)
{
    $reviewDAO = new VeryGoodTrip\DAO\ReviewDAO($app['db']);
    $reviewDAO->setTripDAO($app['dao.trip']);
    $reviewDAO->setUserDAO($app['dao.user']);
    return $reviewDAO;
});

// Register error handler
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Access denied.';
            break;
        case 404:
            $message = 'The requested resource could not be found.';
            break;
        default:
            $message = "Something went wrong.";
    }
    return $app['twig']->render('error.html.twig', array('message' => $message));
});