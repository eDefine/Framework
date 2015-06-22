<?php

namespace Controller;

use Entity\Product;
use Form\ProductForm;

class ProductController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $products = $this->getContainer()->get('productRepository')->findAll();

        return $this->renderView([
            'products' => $products
        ]);
    }

    public function addAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $product = new Product();
        $productForm = new ProductForm('product');

        $productForm->bindData($product);

        if ($this->getParam('product')) {
            $productForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($product);
            $this->getContainer()->get('flashBag')->add('success', sprintf('Product %s has been created.', $product->getName()));

            return $this->redirect($this->getPath('product', 'index'));
        }

        return $this->renderView([
            'productForm' => $productForm
        ]);
    }

    public function editAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $product = $this->getContainer()->get('productRepository')->findOneById($this->getParam('id'));
        $productForm = new ProductForm('product');

        $productForm->bindData($product);

        if ($this->getParam('product')) {
            $productForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($product);
            $this->getContainer()->get('flashBag')->add('success', sprintf('Product %s has been saved.', $product->getName()));

            return $this->redirect($this->getPath('product', 'index'));
        }

        return $this->renderView([
            'product' => $product,
            'productForm' => $productForm
        ]);
    }

    public function removeAction()
    {
        if (!$this->getUser() || !$this->getUser()->hasRole('ADMIN')) {
            $this->getContainer()->get('flashBag')->add('error', 'You do not have access to this page.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $product = $this->getContainer()->get('productRepository')->findOneById($this->getParam('id'));

        $this->getContainer()->get('manager')->remove($product);
        $this->getContainer()->get('flashBag')->add('success', sprintf('Product %s has been removed.', $product->getName()));

        return $this->redirect($this->getPath('product', 'index'));
    }
}