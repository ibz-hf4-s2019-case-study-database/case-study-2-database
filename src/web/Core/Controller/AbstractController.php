<?php

namespace MarkusGehrig\Core\Controller;

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

use \Twig_Loader_Filesystem;
use \Twig_Environment;

abstract class AbstractController {
    /** @var array $data */
    protected $data = [];

    /** @var array $templateDirs */
    protected $templateDirs = [];

    /** @var array $templateDirs */
    protected $needAuthentication = true;

    public function __construct()
    {
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
     * Get the value of templateDirs
     * 
     * @return array
     */ 
    public function getTemplateDirs()
    {
        return $this->templateDirs;
    }

    /**
     * Set the value of templateDirs
     *
     * @param array $templateDirs
     * @return self
     */ 
    public function setTemplateDirs($templateDirs)
    {
        $this->templateDirs = $templateDirs;

        return $this;
    }

    /**
     * @param array $templateDir
     * @return self
     */
    public function addTemplateDir($templateDir) {
        array_push($this->templateDirs, $templateDir);

        return $this;
    }

    /**
     * @param array $parameter
     * @return string
     */
    public function render($parameter = null) {
        $loader = new Twig_Loader_Filesystem($this->templateDirs);
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
        ));

        $template = $this->twig->load($file);
        return $template->render((array) $parameter);
    }

    /**
     * Get the value of needAuthentication
     * 
     * @return boolean
     */ 
    public function getNeedAuthentication()
    {
        return $this->needAuthentication;
    }

    /**
     * Set the value of needAuthentication
     *
     * @return  self
     */ 
    public function setNeedAuthentication($needAuthentication)
    {
        $this->needAuthentication = $needAuthentication;

        return $this;
    }
}