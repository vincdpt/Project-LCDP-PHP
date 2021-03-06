<?php

use Symfony\Component\HttpFoundation\Request;
use PPE_PHP\Domain\Comment;
use PPE_PHP\Domain\Article;
use PPE_PHP\Domain\Produit;
use PPE_PHP\Domain\Famille;
use PPE_PHP\Domain\Visiteur;
use PPE_PHP\Domain\User;
use PPE_PHP\Form\Type\FamilleType;
use PPE_PHP\Form\Type\CommentType;
use PPE_PHP\Form\Type\ProduitType;
use PPE_PHP\Form\Type\VisiteurType;
use PPE_PHP\Form\Type\ArticleType;
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

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
// -- Visiteur
$app->get('/visiteur', function () use ($app) {
    $visiteurs = $app['dao.visiteur']->findAll();
    return $app['twig']->render('visiteur.html.twig', array('visiteurs' => $visiteurs));
})->bind('visiteur');
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
// Add a new visiteur
$app->match('/admin/visiteur/add', function(Request $request) use ($app) {
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
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes

// Article details with comments
$app->match('/article/{id}', function ($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $commentFormView = null;
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // A user is fully authenticated : he can add comments
        $comment = new Comment();
        $comment->setArticle($article);
        $user = $app['user'];
        $comment->setAuthor($user);
        $commentForm = $app['form.factory']->create(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Your comment was successfully added.');
        }
        $commentFormView = $commentForm->createView();
    }
    $comments = $app['dao.comment']->findAllByArticle($id);

    return $app['twig']->render('article.html.twig', array(
        'article' => $article, 
        'comments' => $comments,
        'commentForm' => $commentFormView));
})->bind('article');

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

// Add a new article
$app->match('/admin/article/add', function(Request $request) use ($app) {
    $article = new Article();
    $articleForm = $app['form.factory']->create(ArticleType::class, $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'New article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_add');

// Edit an existing article
$app->match('/admin/article/{id}/edit', function($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(ArticleType::class, $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully updated.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'Edit article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByArticle($id);
    // Delete the article
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The article was successfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_article_delete');

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', function($id, Request $request) use ($app) {
    $comment = $app['dao.comment']->find($id);
    $commentForm = $app['form.factory']->create(CommentType::class, $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', 'The comment was successfully updated.');
    }
    return $app['twig']->render('comment_form.html.twig', array(
        'title' => 'Edit comment',
        'commentForm' => $commentForm->createView()));
})->bind('admin_comment_edit');

// Remove a comment
$app->get('/admin/comment/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.comment']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The comment was successfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_comment_delete');

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

