<?php

namespace MarkusGehrig\Site\Domain\Model;

class SiteModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
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
    protected $length;

    /**
     * @var string
     */
    protected $width;

    /**
     * Get the value of uid
     *
     * @return  int;
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

    /**
     * Get the value of length
     *
     * @return  string
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @param  string  $length
     *
     * @return  self
     */ 
    public function setLength(string $length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of width
     *
     * @return  string
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @param  string  $width
     *
     * @return  self
     */ 
    public function setWidth(string $width)
    {
        $this->width = $width;

        return $this;
    }
}