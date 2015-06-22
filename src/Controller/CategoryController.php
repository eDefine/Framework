<?php

namespace Controller;

use Entity\Category;
use Form\CategoryForm;
use Transaction\Calculator;

class CategoryController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $categories = $this->getContainer()->get('categoryRepository')->findAll();

        return $this->renderView([
            'categories' => $categories
        ]);
    }

    public function viewAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $category = $this->getContainer()->get('categoryRepository')->findOneById($this->getParam('id'));

        $transactions = $this->getContainer()->get('transactionRepository')->findAll(['categoryId' => $category->getId()]);

        $calculator = new Calculator($transactions);

        return $this->renderView([
            'category' => $category,
            'transactions' => $transactions,
            'calculator' => $calculator
        ]);
    }

    public function addAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $categories = $this->getContainer()->get('categoryRepository')->findAll();

        $categoriesOptions = [];
        foreach ($categories as $category) {
            $categoriesOptions[$category->getId()] = $category->getName();;
        }

        $category = new Category();
        $categoryForm = new CategoryForm('category', ['categories' => $categoriesOptions]);

        $categoryForm->bindData($category);

        if ($this->getParam('category')) {
            $categoryForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($category);
            $this->getContainer()->get('flashBag')->add('success', sprintf('Category %s has been created.', $category->getName()));

            return $this->redirect($this->getPath('category', 'index'));
        }

        return $this->renderView([
            'categoryForm' => $categoryForm
        ]);
    }

    public function editAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $categories = $this->getContainer()->get('categoryRepository')->findAll();

        $categoriesOptions = [];
        foreach ($categories as $category) {
            $categoriesOptions[$category->getId()] = $category->getName();;
        }

        $category = $this->getContainer()->get('categoryRepository')->findOneById($this->getParam('id'));
        $categoryForm = new CategoryForm('category', ['categories' => $categoriesOptions]);

        $categoryForm->bindData($category);

        if ($this->getParam('category')) {
            $categoryForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($category);
            $this->getContainer()->get('flashBag')->add('success', sprintf('Category %s has been saved.', $category->getName()));

            return $this->redirect($this->getPath('category', 'index'));
        }

        return $this->renderView([
            'category' => $category,
            'categoryForm' => $categoryForm
        ]);
    }

    public function removeAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }
        
        $category = $this->getContainer()->get('categoryRepository')->findOneById($this->getParam('id'));

        $this->getContainer()->get('manager')->remove($category);
        $this->getContainer()->get('flashBag')->add('success', sprintf('Category %s has been removed.', $category->getName()));

        return $this->redirect($this->getPath('category', 'index'));
    }
}