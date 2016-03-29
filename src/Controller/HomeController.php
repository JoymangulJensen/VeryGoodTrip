<?php

namespace VeryGoodTrip\Controller;

use VeryGoodTrip\Form\Type\UserType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use VeryGoodTrip\Domain\User;
use VeryGoodTrip\Domain\Cart;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $trips = $app['dao.trip']->findRandom(2);
        $images = $app['dao.category']->findRandomImages(5);
        $categories = $app['dao.category']->findAllWithCount();
        return $app['twig']->render('index.html.twig', array(
                                                        'trips' => $trips,
                                                        'categories' => $categories,
                                                        'images' => $images));
    }

    /**
     * Trip details controller
     * @param integer $id Trip id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function tripAction($id, Request $request, Application $app) {
        $trip = $app['dao.trip']->find($id);
        /*$commentFormView = null;
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            // A user is fully authenticated : he can add comments
            $comment = new Comment();
            $comment->setArticle($article);
            $user = $app['user'];
            $comment->setAuthor($user);
            $commentForm = $app['form.factory']->create(new CommentType(), $comment);
            $commentForm->handleRequest($request);
            if ($commentForm->isSubmitted() && $commentForm->isValid()) {
                $app['dao.comment']->save($comment);
                $app['session']->getFlashBag()->add('success', 'Your comment was succesfully added.');
            }
            $commentFormView = $commentForm->createView();
        }
        */

        /*$comments = $app['dao.comment']->findAllByArticle($id);*/
        return $app['twig']->render('trip.html.twig', array('trip' => $trip));
    }

    public function categoryAction($id, Request $request, Application $app) {
        $category = $app['dao.category']->find($id);
        $trips = $app['dao.trip']->findAllByCategory($id);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'trips' => $trips));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }

    /**
     * Sign In Page controller
     *
     * @param Request $request Incoming request
     * @param Application $app $Silex application
     * @return mixed
     */
    public function signInAction(Request $request, Application $app) {
        $user = new User();
        // Warning : constant salt
        $salt = "qUgq3NAYfC1MKwrW?yevbE";
        $user->setSalt($salt);
        $user->setRole("ROLE_USER");

        $encoder = $app['security.encoder.digest'];

        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()){
            // Salt the password of the user
            $user->setPassword($encoder->encodePassword($user->getPassword(), $salt));
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'Your account has been successfully created');
        }
        $userFormView = $userForm->createView();

        return $app['twig']->render('user_form.html.twig', array(
            "title" => "Sign In",
            "userForm" => $userFormView
        ));
    }

    public function cartAction(Request $request, Application $app)
    {
        $carts = Array();
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $user = $app['user'];
            $carts = $app['dao.cart']->find($user->getId());
        }

        return $app['twig']->render('cart.html.twig', array(
            'carts' => $carts,));
    }

    public function addCartAction($id, Request $request, Application $app)
    {
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            $cart = new Cart();
            $trip = $app['dao.trip']->find($id);
            $user = $app['user'];
            $cart->setTrip($trip);
            $cart->setUser($user);
            $app['dao.cart']->save($cart);
        }

        return $app->redirect('/cart');
    }
}
