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
        return $app['twig']->render('trip.html.twig', array('trip' => $trip));
    }

    /**
     * @param $id
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
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

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app) {
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'Edit user',
            'userForm' => $userForm->createView()));
    }

    public function cartAction(Request $request, Application $app)
    {
        $carts = Array();
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $user = $app['user'];
            $carts = $app['dao.cart']->find($user->getId());
        }
        else{
            return $app->redirect('/login');
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

    /**
     * Remove a trip from the cart
     * @param $id : the id of the cart item
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeCartAction($id, Request $request, Application $app)
    {
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {

            $app['dao.cart']->delete($id, $app['user']->getId());
        }
        return $app->redirect('/cart');
    }
}
