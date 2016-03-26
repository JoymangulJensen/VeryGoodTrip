<?php

// Home page
// $app->get('/', "VeryGoodTrip\Controller\HomeController::indexAction")->bind('home');


$app->match('/', "VeryGoodTrip\Controller\HomeController::indexAction")->bind('home');
// Detailed info about a trip
$app->match('/trip/{id}', "VeryGoodTrip\Controller\HomeController::tripAction")->bind('trip');

// Detailed info of a category
$app->match('/category/{id}', "VeryGoodTrip\Controller\HomeController::categoryAction")->bind('category');

// Login form
$app->get('/login', "VeryGoodTrip\Controller\HomeController::loginAction")->bind('login');

// Signin form
$app->match('/signin', "VeryGoodTrip\Controller\HomeController::signInAction")->bind('signin');

$app->match('/cart', "VeryGoodTrip\Controller\HomeController::cartAction")->bind('cart');

/**
 * Temporary create thos route to generate an encryoted password
 */
$app->get('/hashpwd', function() use ($app) {
    $rawPassword = 'admin';
    $salt = '%qUgq3NAYfC1MKwrW?yevbE';
    $encoder = $app['security.encoder.digest'];
    return $encoder->encodePassword($rawPassword, $salt);
});

/*n zone
$app->get('/admin', "MicroCMS\Controller\AdminController::indexAction")->bind('admin');

// Add a new article
$app->match('/admin/article/add', "MicroCMS\Controller\AdminController::addArticleAction")->bind('admin_article_add');

// Edit an existing article
$app->match('/admin/article/{id}/edit', "MicroCMS\Controller\AdminController::editArticleAction")->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', "MicroCMS\Controller\AdminController::deleteArticleAction")->bind('admin_article_delete');

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', "MicroCMS\Controller\AdminController::editCommentAction")->bind('admin_comment_edit');

// Remove a comment
$app->get('/admin/comment/{id}/delete', "MicroCMS\Controller\AdminController::deleteCommentAction")->bind('admin_comment_delete');

// Add a user
$app->match('/admin/user/add', "MicroCMS\Controller\AdminController::addUserAction")->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "MicroCMS\Controller\AdminController::editUserAction")->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "MicroCMS\Controller\AdminController::deleteUserAction")->bind('admin_user_delete');

// API : get all articles
$app->get('/api/articles', "MicroCMS\Controller\ApiController::getArticlesAction")->bind('api_articles');

// API : get an article
$app->get('/api/article/{id}', "MicroCMS\Controller\ApiController::getArticleAction")->bind('api_article');

// API : create an article
$app->post('/api/article', "MicroCMS\Controller\ApiController::addArticleAction")->bind('api_article_add');

// API : remove an article
$app->delete('/api/article/{id}', "MicroCMS\Controller\ApiController::deleteArticleAction")->bind('api_article_delete');
*/