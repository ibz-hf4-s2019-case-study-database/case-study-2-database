<?php

namespace MarkusGehrig\Site\Domain\Model;

class DateModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    /**
     * @var int
     */
    protected $uid;

    /**
     * @var int
     */
    protected $cityId;

    /**
     * @var string
     */
    protected $date;

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
     * Get the value of date
     *
     * @return  string
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param  string  $date
     *
     * @return  self
     */ 
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of cityId
     *
     * @return  int
     */ 
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set the value of cityId
     *
     * @param  int  $cityId
     *
     * @return  self
     */ 
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }
}