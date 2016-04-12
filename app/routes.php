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

// Edit an existing user
$app->match('/user/{id}/edit', "VeryGoodTrip\Controller\HomeController::editUserAction")->bind('user_edit');

// View all cart
$app->match('/cart', "VeryGoodTrip\Controller\HomeController::cartAction")->bind('cart');


// View all cart
$app->match('/addcart/{id}', "VeryGoodTrip\Controller\HomeController::addCartAction")->bind('addcart');

$app->match('/removecart/{id}', "VeryGoodTrip\Controller\HomeController::removeCartAction")->bind("removecart");

/*******************************************************************
 ****                                                           ****
 ****                      Admin Zone                           ****
 ****                                                           ****
 *******************************************************************/
// Trip management
$app->get('/admin/trip', "VeryGoodTrip\Controller\AdminController::indexTripAction")->bind('admin_trip');

// Edit an existing article
$app->match('/admin/trip/{id}/edit', "VeryGoodTrip\Controller\AdminController::editTripAction")->bind('admin_trip_edit');

// Add a new trip
$app->match('/admin/trip/add', "VeryGoodTrip\Controller\AdminController::addTripAction")->bind('admin_trip_add');

// Remove an article
$app->get('/admin/trip/{id}/delete', "VeryGoodTrip\Controller\AdminController::deleteTripAction")->bind('admin_trip_delete');



// Category management
$app->get('/admin/category', "VeryGoodTrip\Controller\AdminController::indexCategoryAction")->bind('admin_category');

// Edit an existing article
$app->match('/admin/category/{id}/edit', "VeryGoodTrip\Controller\AdminController::editCategoryAction")->bind('admin_category_edit');

// Add a new trip
$app->match('/admin/category/add', "VeryGoodTrip\Controller\AdminController::addCategoryAction")->bind('admin_category_add');

// Remove an article
$app->get('/admin/category/{id}/delete', "VeryGoodTrip\Controller\AdminController::deleteCategoryAction")->bind('admin_category_delete');


/**
 * Temporary create thos route to generate an encryoted password
 */
$app->get('/hashpwd', function() use ($app) {
    $rawPassword = 'admin';
    $salt = 'qUgq3NAYfC1MKwrW?yevbE';
    $encoder = $app['security.encoder.digest'];
    return $encoder->encodePassword($rawPassword, $salt);
});

/*n zone



// Edit an existing article
$app->match('/admin/article/{id}/edit', "MicroCMS\Controller\AdminController::editArticleAction")->bind('admin_article_edit');


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