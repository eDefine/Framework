<?php

namespace Controller;

class MealController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $meals = $this->getContainer()->get('mealRepository')->getAllForUser($this->getUser());

        return $this->renderView([
            'meals' => $meals
        ]);
    }

    public function viewAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $meal = $this->getContainer()->get('mealRepository')->findOneById($this->getParam('id'));
        $mealProducts = $this->getContainer()->get('mealProductRepository')->findAll(['mealId' => $meal->getId()]);

        return $this->renderView([
            'meal' => $meal,
            'mealProducts' => $mealProducts
        ]);
    }
}