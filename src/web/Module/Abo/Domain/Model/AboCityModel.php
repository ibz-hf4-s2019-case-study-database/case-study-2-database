<?php

namespace MarkusGehrig\Abo\Domain\Model;

class AboCityModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    /**
     * @var int
     */
    protected $uid, $aboId, $cityId;

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
     * Get the value of aboId
     *
     * @return  int
     */ 
    public function getAboId()
    {
        return $this->aboId;
    }

    /**
     * Set the value of aboId
     *
     * @param  int  $aboId
     *
     * @return  self
     */ 
    public function setAboId(int $aboId)
    {
        $this->aboId = $aboId;

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