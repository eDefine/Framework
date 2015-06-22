<?php

namespace Controller;

use Edefine\Framework\Console\Output\BufferOutput;
use Edefine\Framework\Console\Output\ChainOutput;
use Edefine\Framework\Console\Output\LogOutput;
use Edefine\Framework\Http\DownloadResponse;
use Edefine\Framework\Log\Writer;
use Entity\Weight;
use Form\WeightForm;
use Weight\Calculator;
use Weight\CsvGenerator;

class WeightController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weights = $this->getContainer()->get('weightRepository')->getAllForUser($this->getUser());
        $calculator = new Calculator($weights);

        return $this->renderView([
            'calculator' => $calculator,
            'weights' => $weights
        ]);
    }

    public function addAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weight = new Weight();
        $weight->setUserId($this->getUser()->getId());

        $weightForm = new WeightForm('weight');

        $weightForm->bindData($weight);

        if ($this->getParam('weight')) {
            $weightForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($weight);
            $this->getContainer()->get('flashBag')->add('success', 'Weight has been added.');

            return $this->redirect($this->getPath('weight', 'index'));
        }

        return $this->renderView([
            'weightForm' => $weightForm
        ]);
    }

    public function editAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weight = $this->getContainer()->get('weightRepository')->findOneById($this->getParam('id'));
        $weightForm = new WeightForm('weight');

        $weightForm->bindData($weight);

        if ($this->getParam('weight')) {
            $weightForm->bindRequest($this->getRequest());

            $this->getContainer()->get('manager')->save($weight);
            $this->getContainer()->get('flashBag')->add('success', 'Weight has been added.');

            return $this->redirect($this->getPath('weight', 'index'));
        }

        return $this->renderView([
            'weight' => $weight,
            'weightForm' => $weightForm
        ]);
    }

    public function removeAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weight = $this->getContainer()->get('weightRepository')->findOneById($this->getParam('id'));
        $this->getContainer()->get('manager')->remove($weight);

        $this->getContainer()->get('flashBag')->add('success', 'Weight has been removed.');

        return $this->redirect($this->getPath('weight', 'index'));
    }

    public function printAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weights = $this->getContainer()->get('weightRepository')->getAllForUser($this->getUser());

        $twig = $this->getContainer()->get('twig');
        $html = $twig->render('Weight/pdf.html.twig', [
            'weights' => $weights
        ]);

        $generator = $this->getContainer()->get('pdfGenerator');
        $pdfFile = $generator->generate($html);

        return new DownloadResponse($pdfFile);
    }

    public function exportAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $weights = $this->getContainer()->get('weightRepository')->getAllForUser($this->getUser());

        $csvGenerator = new CsvGenerator();
        $csvFile = $csvGenerator->generate($weights);

        return new DownloadResponse($csvFile);
    }

    public function consolidationAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $writer = new Writer(sprintf('%s/log/weight_consolidation.log', APP_DIR));
        $logOutput = new LogOutput($writer);

        $bufferOutput = new BufferOutput();

        $chainOutput = new ChainOutput();
        $chainOutput->addOutput($bufferOutput);
        $chainOutput->addOutput($logOutput);

        $this->getContainer()->get('weightConsolidation')->run($chainOutput);

        $this->getContainer()->get('flashBag')->add('success', $bufferOutput->getBuffer());

        return $this->redirect($this->getPath('weight', 'index'));
    }
}