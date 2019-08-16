<?php

namespace MarkusGehrig\Core\Dispatcher;

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
use \Exception;

class Dispatcher {
    /**  @var string name of module */
    private $module     = '';

    /**  @var string name of controller */
    private $controller = '';

    /**  @var string name of action */
    private $action     = '';

    /**  @var array data */
    private $data       = [];

    /* @var Symfony\Component\HttpFoundation\Request */
    private $request;
    
    public function __construct(Request $request)
    {
    }

    /**
     * Get the value of module
     * 
     * @return string
     */ 
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the value of module
     *
     * @param string $module
     * @return self
     */ 
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the value of controller
     * 
     * @return string
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @param string $controller
     * @return self
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of action
     * 
     * @return string
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @param string $action
     * @return self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of data
     * 
     * @return array
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param array $data
     * @return self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of request
     * 
     * @return Request
     */ 
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @param Request $request
     * @return self
     */ 
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param string $module
     * @param string $controller
     * @param string $action
     * @param array $data
     */
    public function dispatch($module = null, $controller = null, $action = null, $data = null) {
        $module =           ($module ? $module : $this->request->query->get('controller', 'dashboard'));
        $dashboard =        ($dashboard ? $dashboard : $this->request->query->get('dashboard', 'dashboard'));
        $action =           ($action ? $action : $this->request->query->get('action', 'show'));
        $data =             ($data ? $data : $this->request->query->get('data', null));

        $this->module =     ucfirst($module);
        $this->controller = ucfirst($controller);
        $this->action =     $action . 'Action';
        $this->data =       $data;

        $className = 'MarkusGehrig\\' . $this->module . '\\Controller\\' . $this->controller . 'Controller';
        $html = '';

        try {
            if(!class_exists($classname)) {
                throw new Exception('Class doesn\'t exist.');
            }

            $object = new $classname;
            if ($data) {
                $object->setData($data);
            }
            
            $html = $object->$action();
        }
        catch(Exception $e) {

        }
        finally {
            $response = new Response($html);
            return $response;
        }
    }

    /**
     * 
     */
    public function redirect($module, $controller, $action, $data) {
        dispatch($module, $controller, $action, $data);
    }
}