<?php

namespace MarkusGehrig\Company\Domain\Model;

class CompanyModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
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
    protected $telephone;

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
     * Get the value of telephone
     *
     * @return  string
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param  string  $telephone
     *
     * @return  self
     */ 
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }
}