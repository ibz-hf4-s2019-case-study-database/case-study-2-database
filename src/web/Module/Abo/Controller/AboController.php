<?php

namespace MarkusGehrig\Abo\Controller;

// Copyright (c) 2019 Markus Gehrig
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use MarkusGehrig\Core\Controller\AbstractController;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

use MarkusGehrig\Abo\Domain\Repository\AboRepository;
use MarkusGehrig\Abo\Domain\Repository\AboCityRepository;
use MarkusGehrig\Abo\Domain\Repository\OfferRepository;
use MarkusGehrig\User\Domain\Repository\UserRepository;
use MarkusGehrig\Company\Domain\Repository\CompanyRepository;
use MarkusGehrig\Site\Domain\Repository\CityRepository;

class AboController extends AbstractController {

    private $aboRepository;
    private $offerRepository;
    private $companyRepository;
    private $cityRepository;
    private $aboCityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->addTemplateDir("Module/Abo/Template/Templates");
        $this->addTemplateDir("Module/Abo/Template/Partials");

        $this->aboRepository = new AboRepository();
        $this->offerRepository = new OfferRepository();
        $this->userRepository = new UserRepository();
        $this->companyRepository = new CompanyRepository();
        $this->cityRepository = new CityRepository();
        $this->aboCityRepository = new AboCityRepository();
    }

    public function listAction() {
        $abos = $this->aboRepository->findAll();
        $offers = $this->offerRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("list.html.twig", array('abos' => $abos, 'offers' => $offers)));
        return $response;
    }

    public function newAboAction() {
        $companies = $this->companyRepository->findAll();
        $offers = $this->offerRepository->findAll();
        $cities = $this->cityRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("newAbo.html.twig", array('companies' => $companies, 'offers' => $offers, 'cities' => $cities)));
        return $response;
    }

    public function createAboAction() {
        $this->aboRepository->insertRecord($this->aboRepository->createModel($this->getData()));
        return $this->listAction();
    }

    public function newOfferAction() {
        $response = new Response();
        $response->setContent($this->render("newOffer.html.twig"));
        return $response;
    }

    public function createOfferAction() {    
        $offer = $this->offerRepository->findByUid($this->data['offerId']);

        if($offer->getNumberOfCities() < count($this->data['cities'])) {
            throw new \Exception('The number of selected cities exceeds the max number of the selected offer', 1569228884);
        }
        
        $endDate = new \DateTime($this->data['beginDate']);
        $endDate = $endDate->add(new \DateInterval('P'. $offer->getPeriodOfValidity() .'M'));
        $this->data['endDate'] = strftime('%F', $endDate->getTimestamp());

        $lastInsertedId = $this->aboRepository->insertRecord($this->aboRepository->createModel($this->getData()));
        
        foreach ($this->data['cities'] as $city) {
            $this->aboCityRepository->insertRecord($this->aboCityRepository->createModel(array('aboId' => $lastInsertedId, 'cityId' => $city)));
        }

        return $this->listAction();
    }
}