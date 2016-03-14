<?php

namespace VeryGoodTrip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $trips = $app['dao.trip']->findRandom(2);
        $categories = $app['dao.category']->findAllWithCount();
        return $app['twig']->render('index.html.twig', array(
                                                        'trips' => $trips,
                                                        'categories' => $categories));
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
        return $app['twig']->render('category.html.twig', array('category' => $category));
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
}
