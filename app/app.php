<?php


// Register global error and exception handlers
use Symfony\Component\Debug\ErrorHandler;
ErrorHandler::register();
use Symfony\Component\Debug\ExceptionHandler;
ExceptionHandler::register();
// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new TINTA\DAO\UtilisateurDAO($app['db']);
            }),
        ),
    ),
));


// Register services.
$app['dao.locataire'] = $app->share(function ($app) {
    return new TINTA\DAO\LocataireDAO($app['db']);
});	
	// Register services.
$app['dao.equipement'] = $app->share(function ($app) {
    return new TINTA\DAO\EquipementDAO($app['db']);
});
// Register services.
$app['dao.forfait'] = $app->share(function ($app) {
    return new TINTA\DAO\ForfaitDAO($app['db']);
});

// Register services.
$app['dao.typeVilla'] = $app->share(function ($app) {
    return new TINTA\DAO\TypeVillaDAO($app['db']);
});
$app['dao.villa'] = $app->share(function ($app) {
    $villaDAO = new TINTA\DAO\VillaDAO($app['db']);
    $villaDAO->setTypeVillaDAO($app['dao.typeVilla']);
    return $villaDAO;
});
$app['dao.reservation'] = $app->share(function ($app) {
    $reservationDAO = new TINTA\DAO\ReservationDAO($app['db']);
    $reservationDAO->setIdLocataireDAO($app['dao.locataire']);
    $reservationDAO->setIdVillaDAO($app['dao.villa']);
    $reservationDAO->setIdForfaitDAO($app['dao.forfait']);
    return $reservationDAO;
});
$app['dao.utilisateur'] = $app->share(function ($app) {
    return new TINTA\DAO\UtilisateurDAO($app['db']);
});
$app['dao.comment'] = $app->share(function ($app) {
    $commentDAO = new TINTA\DAO\CommentDAO($app['db']);
    $commentDAO->setReservationDAO($app['dao.reservation']);
    $commentDAO->setUtilisateurDAO($app['dao.utilisateur']);
    return $commentDAO;
});
$app['dao.date'] = $app->share(function ($app) {
    return new TINTA\DAO\DateResaDAO($app['db']);
});
