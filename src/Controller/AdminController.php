<?php

namespace VeryGoodTrip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VeryGoodTrip\Domain\Trip;
use VeryGoodTrip\Domain\User;
use VeryGoodTrip\Form\Type\TripType;
use VeryGoodTrip\Form\Type\CommentType;
use VeryGoodTrip\Form\Type\UserType;

class AdminController
{

    /**
     * Admin trip management page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app)
    {
        $trips = $app['dao.trip']->findAll();
        return $app['twig']->render('admin_trip.html.twig', array(
            'trips' => $trips));
    }

    /**
     * Add trip controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addTripAction(Request $request, Application $app)
    {
        $categories = $app['dao.category']->findAll();
        $trip = new Trip();
        $tripForm = $app['form.factory']->create(new TripType($categories), $trip);
        $tripForm->handleRequest($request);
        if ($tripForm->isSubmitted() && $tripForm->isValid()) {
            $files = $request->files->get($tripForm->getName());
            $path = __DIR__ . '/../../web/images/';
            $filename = $files['image']->getClientOriginalName();
            $files['image']->move($path, $filename);
            $trip->setImage('./images/' . $filename);
            $app['dao.trip']->save($trip);

            $app['session']->getFlashBag()->add('success', 'The trip was successfully created.');
        }
        return $app['twig']->render('trip_form.html.twig', array(
            'title' => 'Ajouter un séjour',
            'tripForm' => $tripForm->createView()));
    }


    /**
     * Edit trip controller.
     *
     * @param integer $id Trip id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editTripAction($id, Request $request, Application $app)
    {
        $categories = $app['dao.category']->findAll();
        $trip = $app['dao.trip']->find($id);
        $temp = $trip;
        $tripForm = $app['form.factory']->create(new TripType($categories), $trip);

        $tripForm->handleRequest($request);
        if ($tripForm->isSubmitted() && $tripForm->isValid()) {
            $files = $request->files->get($tripForm->getName());
            if ($files['image'] != null) {
                $path = __DIR__ . '/../../web/images/';
                $filename = $files['image']->getClientOriginalName();
                $files['image']->move($path, $filename);
                $trip->setImage('./images/' . $filename);
                $app['dao.trip']->save($trip);
            } else {
                $trip->setImage($temp->getImage());
            }


            $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
        }
        return $app['twig']->render('trip_form.html.twig', array(
            'title' => 'Modifier un séjour',
            'tripForm' => $tripForm->createView()));
    }

    /**
     * Delete trip controller.
     *
     * @param integer $id Trip id
     * @param Application $app Silex application
     */
    public function deleteTripAction($id, Application $app)
    {
        // Delete the trip
        $app['dao.trip']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The trip was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin_trip'));
    }












    

    /**
     * Add article controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addArticleAction(Request $request, Application $app)
    {
        $article = new Article();
        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('trip_form.html.twig', array(
            'title' => 'New article',
            'articleForm' => $articleForm->createView()));
    }


    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deleteArticleAction($id, Application $app)
    {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByArticle($id);
        // Delete the article
        $app['dao.article']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Edit comment controller.
     *
     * @param integer $id Comment id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editCommentAction($id, Request $request, Application $app)
    {
        $comment = $app['dao.comment']->find($id);
        $commentForm = $app['form.factory']->create(new CommentType(), $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'The comment was succesfully updated.');
        }
        return $app['twig']->render('comment_form.html.twig', array(
            'title' => 'Edit comment',
            'commentForm' => $commentForm->createView()));
    }

    /**
     * Delete comment controller.
     *
     * @param integer $id Comment id
     * @param Application $app Silex application
     */
    public function deleteCommentAction($id, Application $app)
    {
        $app['dao.comment']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The comment was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addUserAction(Request $request, Application $app)
    {
        $user = new User();
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // generate a random salt value
            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();
            // find the default encoder
            $encoder = $app['security.encoder.digest'];
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'New user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app)
    {
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

    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app)
    {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByUser($id);
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
}
