<?php

namespace MarkusGehrig\Site\Domain\Model;

class CityModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    /**
     * @var int
     */
    protected $uid;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $address;


    /**
     * Get the value of uid
     *
     * @return  int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set the value of uid
     *
     * @param  int  $uid
     *
     * @return  self
     */ 
    public function setUid(int $uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of zip
     *
     * @return  string
     */ 
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set the value of zip
     *
     * @param  string  $zip
     *
     * @return  self
     */ 
    public function setZip(string $zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string  $address
     *
     * @return  self
     */ 
    public function setAddress(string $address)
    {
        $this->address = $address;

        return $this;
    }
}