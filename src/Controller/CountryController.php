<?php

namespace Controller;

class CountryController extends AbstractController
{
    public function indexAction()
    {
        $countries = $this->getContainer()->get('countryRepository')->findAll();

        return $this->renderView([
            'countries' => $countries
        ]);
    }
}