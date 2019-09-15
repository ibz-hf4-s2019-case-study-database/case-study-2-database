<?php

namespace MarkusGehrig\User\Controller;

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

use MarkusGehrig\Company\Domain\Repository\CompanyRepository;
use MarkusGehrig\User\Domain\Repository\UserRepository;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class UserController extends AbstractController {

    private $companyRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->addTemplateDir("Module/User/Template/Templates");
        $this->addTemplateDir("Module/User/Template/Partials");

        $this->companyRepository = new CompanyRepository();
        $this->userRepository = new UserRepository();
    }
    public function listAction() {
        $users = $this->userRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("list.html.twig", array('users' => $users)));
        return $response;
    }
    public function newUserAction() {
        $companies = $this->companyRepository->findAll();

        $response = new Response();
        $response->setContent($this->render("newUser.html.twig", array('companies' => $companies)));
        return $response;
    }
    public function createUserAction() {
        $this->userRepository->insertRecord($this->userRepository->createModel($this->data));
        return $this->listAction();
    }
}