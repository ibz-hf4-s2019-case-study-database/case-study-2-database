<?php

namespace MarkusGehrig\Reservation\Domain\Model;

use MarkusGehrig\Site\Domain\Repository\DateRepository;
use MarkusGehrig\Site\Domain\Repository\CityRepository;
use MarkusGehrig\Site\Domain\Repository\SiteRepository;
use MarkusGehrig\Company\Domain\Repository\CompanyRepository;


class ReservationModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    protected $uid, $companyId, $cityId, $dateId, $siteId;

    /**
     * Get the value of uid
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set the value of uid
     *
     * @return  self
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get the value of companyId
     */ 
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set the value of companyId
     *
     * @return  self
     */ 
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get the value of cityId
     */ 
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set the value of cityId
     *
     * @return  self
     */ 
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get the value of dateId
     */ 
    public function getDateId()
    {
        return $this->dateId;
    }

    /**
     * Set the value of dateId
     *
     * @return  self
     */ 
    public function setDateId($dateId)
    {
        $this->dateId = $dateId;

        return $this;
    }

    /**
     * Get the value of siteId
     */ 
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set the value of siteId
     *
     * @return  self
     */ 
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;

        return $this;
    }

    /**
     */ 
    public function getDate()
    {
        return ((new DateRepository())->findByUid($this->getDateId()))->getDate();
    }

    /**
     */ 
    public function getCompany()
    {
        return ((new CompanyRepository())->findByUid($this->getCompanyId()))->getName();
    }

    /**
     */ 
    public function getCity()
    {
        return ((new CityRepository())->findByUid($this->getCityId()))->getName();
    }

     /**
     */ 
    public function getSite()
    {   
        $site = (new SiteRepository())->findByUid($this->getSiteId());
        return $site->getUid() . ', ' . $site->getWidth() . 'x' . $site->getLength();
    }
    
}