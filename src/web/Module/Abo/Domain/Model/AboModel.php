<?php

namespace MarkusGehrig\Abo\Domain\Model;

use MarkusGehrig\Company\Domain\Repository\CompanyRepository;
use MarkusGehrig\Abo\Domain\Repository\OfferRepository;

class AboModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    /**
     * @var int
     */
    protected $uid;

    protected $companyId, $offerId, $beginDate, $endDate;


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
     * Get the value of offerId
     */ 
    public function getOfferId()
    {
        return $this->offerId;
    }

    /**
     * Set the value of offerId
     *
     * @return  self
     */ 
    public function setOfferId($offerId)
    {
        $this->offerId = $offerId;

        return $this;
    }

    /**
     * Get the value of beginDate
     */ 
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set the value of beginDate
     *
     * @return  self
     */ 
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getCompanyName() {
        return ((new CompanyRepository())->findByUid($this->getCompanyId()))->getName();
    }

    public function getOfferName() {
        return ((new OfferRepository())->findByUid($this->getOfferId()))->getTitle();
    }
}