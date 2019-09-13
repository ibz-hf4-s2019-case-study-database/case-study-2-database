<?php

namespace MarkusGehrig\Site\Controller;

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
use MarkusGehrig\Site\Domain\Repository\SiteRepository;
use MarkusGehrig\Site\Domain\Repository\CityRepository;
use MarkusGehrig\Site\Domain\Repository\DateRepository;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class SiteController extends AbstractController {

    private $siteRepository;
    private $cityRepository;
    private $dateRepository;

    public function __construct()
    {
        parent::__construct();
        $this->addTemplateDir("Module/Site/Template/Templates");
        $this->addTemplateDir("Module/Site/Template/Partials");

        $this->siteRepository = new SiteRepository();
        $this->cityRepository = new CityRepository();
        $this->dateRepository = new DateRepository();
    }

    public function showAction() {
        $city = $this->cityRepository->findByUid($this->data['cityUid']);
        $response = new Response();
        $response->setContent($this->render("show.html.twig", array('city' => $city, 'cityId' => $this->data['cityUid'])));
        return $response;
    }

    public function listAction() {
        $response = new Response();

        $city = $this->cityRepository->findAll();

        $response->setContent($this->render("list.html.twig", array('cities' => $city)));
        return $response;
    }

    public function reservationAction() {
        $cityId = $this->data['cityId'];
        $return = [
            '12.08.2019' => [
                '1' => [
                    'company' => [
                        'name' => 'Bio Bauerhof Aarau',
                        'street' => 'Bahnhofstrasse 1a',
                        'zip' => '5000',
                        'city' => 'Aarau',
                    ]
                ],
                '2' => [
                    'company' => [
                        'name' => 'Bio Bauerhof Baden',
                        'street' => 'Badnerstrasse 1a',
                        'zip' => '5250',
                        'city' => 'Baden',
                    ]
                ]
            ],
            '19.08.2019' => [
                '3' => [
                    'company' => [
                        'name' => 'Bio Bauerhof Aarau',
                        'street' => 'Bahnhofstrasse 1a',
                        'zip' => '5000',
                        'city' => 'Aarau',
                    ]
                ],
                '4' => [
                    'company' => [
                        'name' => 'Bio Bauerhof Baden',
                        'street' => 'Badnerstrasse 1a',
                        'zip' => '5250',
                        'city' => 'Baden',
                    ]
                ]
            ]
        ];

        return JsonResponse::fromJsonString(json_encode($return));
    }

    public function placeAction() {
        
        $cityId = $this->data['cityId'];
        $data = $this->siteRepository->findByCityId($cityId);

        $return = [];
        foreach ($data as $site) {
            $return[$site->getUid()]['width'] = $site->getWidth();
            $return[$site->getUid()]['length'] = $site->getLength();
        }

        return JsonResponse::fromJsonString(json_encode($return));
    }

    public function dateAction() {
        $cityId = $this->data['cityId'];
        $dates = $this->dateRepository->findAll();

        $return['cityId'] = $cityId;
        foreach ($dates as $date) {
            $return['dates'][$date->getUid()]['date'] = $date->getDate();
        }

        return JsonResponse::fromJsonString(json_encode($return));
    }

    public function newSiteAction() {
        $response = new Response();
        $response->setContent($this->render("newSite.html.twig"));
        return $response;
    }

    public function createSiteAction() {
        return newSiteAction();
    }

    public function newReservationAction() {
        $response = new Response();
        $response->setContent($this->render("newReservation.html.twig"));
        return $response;
    }

    public function newCityAction() {
        $response = new Response();
        $response->setContent($this->render("newCity.html.twig"));
        return $response;
    }

    public function createCityAction() {
        $this->cityRepository->insertRecord($this->cityRepository->createModel($this->getData()));
        return $this->listAction();
    }

    public function newDateAction() {
        $response = new Response();
        $response->setContent($this->render("newDate.html.twig", array("cityId" => $this->data['cityId'])));
        return $response;
    }

    public function createDateAction() {;
        $this->dateRepository->insertRecord($this->dateRepository->createModel($this->data));
        return $this->showAction();
    }

    public function newPlaceAction() {
        $response = new Response();
        $response->setContent($this->render("newPlace.html.twig", array("cityId" => $this->data['cityId'])));
        return $response;
    }

    public function createPlaceAction() {
        $this->siteRepository->insertRecord($this->siteRepository->createModel($this->data));
        $this->data['cityUid'] = $this->data['cityId'];
        return $this->showAction();
    }
}