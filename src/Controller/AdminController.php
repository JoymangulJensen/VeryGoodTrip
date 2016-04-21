<?php

namespace VeryGoodTrip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use VeryGoodTrip\Domain\Trip;
use VeryGoodTrip\Domain\Category;
use VeryGoodTrip\Form\Type\TripType;
use VeryGoodTrip\Form\Type\CategoryType;

/**
     * Class AdminController : provides all the controllers managing the administration side of the website
 * @package VeryGoodTrip\Controller
 */
class AdminController
{

    /**
     * Admin trip management page controller.
     *
     * @param Application $app Silex application
     */
    public function indexTripAction(Application $app)
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

            $app['session']->getFlashBag()->add('success', 'Le séjour a bien été crée');
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
        //Store the image of current in case user does not modify the current image
        $tempimg = $trip->getImage();
        $tripForm = $app['form.factory']->create(new TripType($categories), $trip);

        $tripForm->handleRequest($request);
        if ($tripForm->isSubmitted() && $tripForm->isValid()) {
            $files = $request->files->get($tripForm->getName());
            if ($files['image'] != null) //if the user modifies the current image
            {
                $path = __DIR__ . '/../../web/images/';
                $filename = $files['image']->getClientOriginalName();
                $files['image']->move($path, $filename);
                $trip->setImage('./images/' . $filename);
                $app['dao.trip']->save($trip);
            } else {
                $trip->setImage($tempimg);
                $app['dao.trip']->save($trip);
            }
            $app['session']->getFlashBag()->add('success', 'Mise à jour réussie');
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse redirect toward admin_trip page
     */
    public function deleteTripAction($id, Application $app)
    {
        // Delete the trip
        $app['dao.trip']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Séjour supprimé');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin_trip'));
    }

    /**
     * Admin category management page controller.
     * @param Application $app Silex application
     * @return Application $app Silex application
     */
    public function indexCategoryAction(Application $app)
    {
        $categories = $app['dao.category']->findAll();
        return $app['twig']->render('admin_category.html.twig', array(
            'categories' => $categories));
    }

    /**
     * Add category controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addCategoryAction(Request $request, Application $app)
    {
        $category = new Category();
        $categoryForm = $app['form.factory']->create(new CategoryType(), $category);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $files = $request->files->get($categoryForm->getName());
            $path = __DIR__ . '/../../web/images/';
            $filename = $files['image']->getClientOriginalName();
            $files['image']->move($path, $filename);
            $category->setImage('./images/' . $filename);
            $app['dao.category']->save($category);

            $app['session']->getFlashBag()->add('success', 'la catégorie a bien été créée');
        }
        return $app['twig']->render('category_form.html.twig', array(
            'title' => 'Ajouter une catégorie',
            'categoryForm' => $categoryForm->createView()));
    }


    /**
     * Edit category controller.
     *
     * @param integer $id Category id
     * @param Request $request Incoming request
     * @param Application $app Silex Application
     * @return Application $app Silex Application
     */
    public function editCategoryAction($id, Request $request, Application $app)
    {
        $category = $app['dao.category']->find($id);
        $categoryForm = $app['form.factory']->create(new CategoryType(), $category);
        $tempimg = $category->getImage();
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $files = $request->files->get($categoryForm->getName());
            if ($files['image'] != null) {
                $path = __DIR__ . '/../../web/images/';
                $filename = $files['image']->getClientOriginalName();
                $files['image']->move($path, $filename);
                $category->setImage('./images/' . $filename);
            } else {
                $category->setImage($tempimg);
            }
            $app['dao.category']->save($category);
            $app['session']->getFlashBag()->add('success', 'Mise à jour réussie');
        }
        return $app['twig']->render('category_form.html.twig', array(
            'title' => 'Modifier un séjour',
            'categoryForm' => $categoryForm->createView()));
    }

    /**
     * Delete category controller.
     *
     * @param integer $id Category id
     * @param Application $app Silex application
     * @return \Symfony\Component\HttpFoundation\RedirectResponse Redirect toward the admin_category page
     */
    public function deleteCategoryAction($id, Application $app)
    {
        //Delete all trips associated with the category
        $app['dao.trip']->deleteAllByCategory($id);
        // Delete the trip
        $app['dao.category']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Catégorie supprimée');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin_category'));
    }

}
