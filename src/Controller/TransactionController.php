<?php

namespace Controller;

use Edefine\Framework\Http\DownloadResponse;
use Entity\Transaction;
use Form\TransactionForm;
use Form\TransactionImportForm;
use Form\ValueObject\TransactionImportObject;
use Transaction\Calculator;
use Transaction\CsvGenerator;

class TransactionController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $sort = $this->getParam('sort', 'id');
        $page = $this->getParam('page', 1);

        $transactions = $this->getTransactionRepository()->getAllForUser($this->getUser(), $sort, $page);

        $calculator = new Calculator($transactions);

        return $this->renderView([
            'transactions' => $transactions,
            'calculator' => $calculator,
            'sort' => $sort,
            'page' => $page
        ]);
    }

    public function addAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $transaction = new Transaction();
        $transactionForm = new TransactionForm('transaction');

        $transactionForm->bindData($transaction);

        if ($this->getParam('transaction')) {
            $transactionForm->bindRequest($this->getRequest());

            $this->getTransactionManager()->save($transaction);

            return $this->redirect($this->getPath('transaction', 'index'));
        }

        return $this->renderView([
            'transactionForm' => $transactionForm
        ]);
    }

    public function editAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $transaction = $this->getTransactionRepository()->findOneById($this->getParam('id'));
        $transactionForm = new TransactionForm('transaction');

        $transactionForm->bindData($transaction);

        if ($this->getParam('transaction')) {
            $transactionForm->bindRequest($this->getRequest());

            $this->getTransactionManager()->save($transaction);

            return $this->redirect($this->getPath('transaction', 'index'));
        }

        return $this->renderView([
            'transaction' => $transaction,
            'transactionForm' => $transactionForm
        ]);
    }

    public function removeAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $transaction = $this->getContainer()->get('transactionRepository')->findOneById($this->getParam('id'));

        $this->getTransactionManager()->remove($transaction);

        return $this->redirect($this->getPath('transaction', 'index'));
    }

    public function exportAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $transactions = $this->getContainer()->get('transactionRepository')->findAll();

        $csvGenerator = new CsvGenerator();
        $csvFile = $csvGenerator->generate($transactions);

        return new DownloadResponse($csvFile);
    }

    public function importAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $transactionImport = new TransactionImportObject();
        $transactionImportForm = new TransactionImportForm('transactionImport');

        $transactionImportForm->bindData($transactionImport);

        if ($this->getParam('transactionImport')) {
            $transactionImportForm->bindRequest($this->getRequest());

            $importer = $this->getContainer()->get('transactionImporter');

            try {
                $rows = $importer->import($transactionImport->getFile());
                $this->getContainer()->get('flashBag')->add('success', sprintf('%d rows has been imported.', $rows));
            } catch (\Exception $ex) {
                $this->getContainer()->get('flashBag')->add('error', $ex->getMessage());
                return $this->redirect($this->getPath('transaction', 'import'));
            }

            return $this->redirect($this->getPath('transaction', 'index'));
        }

        return $this->renderView([
            'transactionImportForm' => $transactionImportForm
        ]);
    }

    /**
     * @return \Service\TransactionManager
     */
    private function getTransactionManager()
    {
        return $this->getContainer()->get('transactionManager');
    }

    /**
     * @return \Repository\TransactionRepository
     */
    private function getTransactionRepository()
    {
        return $this->getContainer()->get('transactionRepository');
    }
}