<?php

namespace MarkusGehrig\Reservation\Controller;

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

use MarkusGehrig\Company\Domain\Repository\CompanyRepository;
use MarkusGehrig\Site\Domain\Repository\CityRepository;
use MarkusGehrig\Site\Domain\Repository\DateRepository;
use MarkusGehrig\Site\Domain\Repository\SiteRepository;
use MarkusGehrig\Reservation\Domain\Repository\ReservationRepository;

class ReservationController extends AbstractController {

    private $companyRepository;
    private $cityRepository;
    private $dateRepository;
    private $siteRepository;
    private $reservationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->addTemplateDir("Module/Reservation/Template/Templates");
        $this->addTemplateDir("Module/Reservation/Template/Partials");

        $this->companyRepository = new CompanyRepository();
        $this->cityRepository = new CityRepository();
        $this->dateRepository = new DateRepository();
        $this->siteRepository = new SiteRepository();
        $this->reservationRepository = new ReservationRepository();
    }

    public function listAction() {
        $reservations = $this->reservationRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("list.html.twig", array('reservations' => $reservations)));
        return $response;
    }

    public function newReservationAction() {
        $companies = $this->companyRepository->findAll();
        $cities = $this->cityRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("newReservation.html.twig", array('companies' => $companies, 'cities' => $cities)));
        return $response;
    }

    public function createReservationAction() {
        $this->reservationRepository->insertRecord($this->reservationRepository->createModel($this->getData()));
        return $this->listAction();
    }

    public function dateAction() {
        $cityId = $this->data['cityId'];
        $dates = $this->dateRepository->findByCityId($cityId);

        foreach ($dates as $date) {
            $return[$date->getUid()]['date'] = $date->getDate();
        }

        return JsonResponse::fromJsonString(json_encode($return));
    }

    public function siteAction() {
        $cityId = $this->data['cityId'];
        $sites = $this->siteRepository->findByCityId($cityId);

        foreach ($sites as $site) {
            $return[$site->getUid()]['site'] = $site->getUid() . ', ' .$site->getLength() . 'x' . $site->getWidth();
        }

        return JsonResponse::fromJsonString(json_encode($return));
    }
}