<?php

use Symfony\Component\HttpFoundation\Request;
use PPE_PHP\Domain\Produit;
use PPE_PHP\Domain\Famille;
use PPE_PHP\Domain\Secteur;
use PPE_PHP\Domain\Visiteur;
use PPE_PHP\Domain\User;
use PPE_PHP\Form\Type\FamilleType;
use PPE_PHP\Form\Type\ProduitType;
use PPE_PHP\Form\Type\VisiteurType;
use PPE_PHP\Form\Type\SecteurType;
use PPE_PHP\Form\Type\UserType;

// Home form
$app->get('/', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('home');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Home page
// -- Produit
$app->get('/produit', function () use ($app) {
    $produits = $app['dao.produit']->findAll();
    $famille = $app['dao.famille']->findAll();
    return $app['twig']->render('produit.html.twig', array('produits' => $produits));
})->bind('produit');


// Add a new produit
$app->match('/admin/produit/add', function(Request $request) use ($app) {
    $produit = new Produit();
    $famille = new Famille();;
    $familleForm = $app['form.factory']->create(familleType::class, $famille);
    $familleForm->handleRequest($request);
    $produitForm = $app['form.factory']->create(ProduitType::class, $produit);
    $produitForm->handleRequest($request);
    if ($produitForm->isSubmitted() && $produitForm->isValid()) {
        $app['dao.produit']->save($produit);
        $app['session']->getFlashBag()->add('success', 'Le produit à bien été créé.');
    }
    return $app['twig']->render('produit_form.html.twig', array(
        'nom' => 'Nouveau produit',
        'produitForm' => $produitForm->createView(),
        'familleForm' => $familleForm->createView(),
        'famille' => $famille));
})->bind('admin_produit_add');



// Admin home page
$app->get('/admin', function() use ($app) {
    $articles = $app['dao.article']->findAll();
    $comments = $app['dao.comment']->findAll();
    $produits = $app['dao.produit']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'articles' => $articles,
        'comments' => $comments,
        'produits' => $produits,
        'users' => $users));
})->bind('admin');

// Add a user
$app->match('/admin/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(UserType::class, $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.bcrypt'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(UserType::class, $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByUser($id);
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was successfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_user_delete');



// ------------- Section visiteur : Vincent DUPONT ----------------

// -- Accès à Visiteur
$app->get('/visiteur', function () use ($app) {
    $visiteurs = $app['dao.visiteur']->findAll();
    return $app['twig']->render('visiteur.html.twig', array('visiteurs' => $visiteurs));
})->bind('visiteur');





// Ajouter un visiteur

$app->match('/admin/visiteur/add', function(Request $request) use ($app) {
    $secteur = new Secteur();
    $visiteur = new Visiteur();
    $visiteurForm = $app['form.factory']->create(VisiteurType::class, $visiteur);
    $visiteurForm->handleRequest($request);
    if ($visiteur->isSubmitted() && $visiteurForm->isValid()) {
        $app['dao.visiteur']->save($visiteur);
        $app['session']->getFlashBag()->add('success', 'Le visiteur a bien été créé.');
    }
    return $app['twig']->render('visiteur_form.html.twig', array(
        'nom' => 'Nouveau visiteur',
        'visiteurForm' => $visiteurForm->createView()));
})->bind('admin_visiteur_add');

