<?php

use Symfony\Component\HttpFoundation\Request;
use TINTA\Domain\Utilisateur;
use TINTA\Domain\Reservation;
use TINTA\Domain\Villa;
use TINTA\Domain\Locataire;
use TINTA\Domain\Equipement;
use TINTA\Form\Type\ReservationType;
use TINTA\Form\Type\LocataireType;
use TINTA\Form\Type\VillaType;
use TINTA\Form\Type\EquipementType;

// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

// Détails sur un locataire
//$app->get('/locataire/{id}', function($id) use ($app) //{
 //   $locataire = $app['dao.locataire']->find($id);
   // return $app['twig']->render('locataire.html.twig', array('locataire' => $locataire));
//})->bind('locataire');

// Liste de tous les locataires
$app->get('/locataire/', function() use ($app) {
    $locataires = $app['dao.locataire']->findAll();
    return $app['twig']->render('locataires.html.twig', array('locataires' => $locataires));
})->bind('locataires');

// ajouter locataire
$app->match('/locataire/ajout', function(Request $request) use ($app) {
    $locataire = new Locataire();
        $locataires = $app['dao.locataire']->findAll();
    $locFormView = null;
            $locForm = $app['form.factory']->create(new LocataireType(),$locataire);
    $locForm->handleRequest($request);
	    if ($locForm->isSubmitted() && $locForm->isValid()) {
			        // Sauvegarde le nouveau locataire
        $app['dao.locataire']->save($locataire);
        $app['session']->getFlashBag()->add('success', 	'le locataire a été sauvegardé .');
    }
    $locFormView = $locForm->createView();
    return $app['twig']->render('locataire_ajout.html.twig', array('locForm' => $locFormView));
})->bind('loc_ajouter');




// Liste de toutes les villas
$app->get('/villa/', function() use ($app) {
    $villas = $app['dao.villa']->findAll();
    return $app['twig']->render('villas.html.twig', array('villas' => $villas));
})->bind('villas');




// ajouter villa
$app->match('/villa/ajout', function(Request $request) use ($app) {                
    $villa = new Villa();
    $typesVillas = $app['dao.typeVilla']->findAll();
    $villaFormView = null;
    $villaForm = $app['form.factory']->create(new VillaType($typesVillas),$villa);
    $villaForm->handleRequest($request);
    if ($villaForm->isSubmitted() && $villaForm->isValid()) {
        
         // Ajoute manuellement le type de villa a la nouvelle villa
        $typeVilla = $resaForm->get('typeVilla')->getData();
        $idTypeVilla = $app['dao.typeVilla']->find($typeVilla);
        $reservation->setTypeVilla($typeVilla);
        // Sauvegarde la nouvelle villa
        $app['dao.villa']->save($villa);
        $app['session']->getFlashBag()->add('success', 'La villa a été sauvegardé.');
    }
    $villaFormView = $villaForm->createView();
    return $app['twig']->render('villa_ajout.html.twig', array('villaForm' => $villaFormView));
})->bind('villa_ajouter');





// connexion
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');


// Liste de toutes les réservations
$app->get('/reservation/', function() use ($app) {
    $reservations = $app['dao.reservation']->findAll();
    return $app['twig']->render('reservations.html.twig', array('reservations' => $reservations));
})->bind('reservations');

// Recherche de réservations
$app->get('/reservation/recherche/', function() use ($app) {
    $villas = $app['dao.villa']->findAll();
    return $app['twig']->render('reservations_recherche.html.twig', array('villas' => $villas));
})->bind('reservation_recherche');

// Résultats de la recherche de réservations
$app->post('/reservation/resultats/', function(Request $request) use ($app) {
    $villaId = $request->request->get('villa');
    $reservations = $app['dao.reservation']->findAllByVilla($villaId);
    return $app['twig']->render('reservations_resultats.html.twig', array('reservations' => $reservations));
})->bind('reservation_resultats');



// ajouter une réservation
$app->match('/reservation/ajout', function(Request $request) use ($app) {
    $reservation = new Reservation();
      $locataires = $app['dao.locataire']->findAll();
      $villas = $app['dao.villa']->findAll();
	$forfaits = $app['dao.forfait']->findAll();
    $resaFormView = null;
        $resaForm = $app['form.factory']->create(new ReservationType($locataires, $villas, $forfaits),$reservation);
    $resaForm->handleRequest($request);
    
    if ($resaForm->isSubmitted() && $resaForm->isValid()) {
         // Ajoute manuellement le locataire a la nouvelle réservation
        $locataireId = $resaForm->get('locataire')->getData();
        $idLocataire = $app['dao.locataire']->find($locataireId);
        $reservation->setIdLocataire($idLocataire);
        
         // Ajoute manuellement la villa a la nouvelle réservation
        $villaId = $resaForm->get('villa')->getData();
        $idVilla = $app['dao.villa']->find($villaId);
        $reservation->setIdVilla($idVilla);
		
		  // Ajoute manuellement le forfait a la nouvelle réservation
        $forfaitId = $resaForm->get('forfait')->getData();
        $idForfait = $app['dao.forfait']->find($forfaitId);
        $reservation->setIdForfait($idForfait);
        
        // Sauvegarde la nouvelle réservation
        $app['dao.reservation']->save($reservation);
        $app['session']->getFlashBag()->add('success', 'La réservation a été sauvegardé.');
    }
    $resaFormView = $resaForm->createView();
    return $app['twig']->render('reservation_ajout.html.twig', array('resaForm' => $resaFormView));
})->bind('reservation_ajouter');


// supprimer une réservation
$app->DELETE('/reservation/supprime/{id}', function ($id, Request $request) use ($app) {
	$app['dao.reservation']->DELETE($id);

	return $app->json('No content', 204);
})->bind('reservation_supprimer');


// planning
$app->get('/date/', function() use ($app) {
    $dates = $app['dao.date']->findAll();
    return $app['twig']->render('dates.html.twig', array('dates' => $dates));
})->bind('dates');

// Liste de tous les équipements
$app->get('/equipement/', function() use ($app) {
    $equipements = $app['dao.equipement']->findAll();
    return $app['twig']->render('equipements.html.twig', array('equipements' => $equipements));
})->bind('equipements');

// ajouter un equipement
$app->match('/equipement/ajout', function(Request $request) use ($app) {                
    $equipement = new Equipement();
    $equiFormView = null;
    $equiForm = $app['form.factory']->create(new EquipementType(),$equipement);
    $equiForm->handleRequest($request);
    if ($equiForm->isSubmitted() && $equiForm->isValid()) {

        // Sauvegarde le nouvel equipement
        $app['dao.equipement']->save($equipement);
        $app['session']->getFlashBag()->add('success', 'L\'équipement a été sauvegardé.');
    }
    $equiFormView = $equiForm->createView();
    return $app['twig']->render('equipement_ajout.html.twig', array('equiForm' => $equiFormView));
})->bind('equipement_ajouter');

// Liste de tous les forfaits
$app->get('/forfait/', function() use ($app) {
    $forfaits = $app['dao.forfait']->findAll();
    return $app['twig']->render('forfaits.html.twig', array('forfaits' => $forfaits));
})->bind('forfaits');

