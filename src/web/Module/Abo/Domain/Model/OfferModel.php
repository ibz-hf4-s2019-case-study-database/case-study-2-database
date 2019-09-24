<?php

namespace MarkusGehrig\Abo\Domain\Model;

class OfferModel extends \MarkusGehrig\Core\Domain\Model\AbstractModel {
    
    /**
     * @var int
     */
    protected $uid;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $beginDate;

    /**
     * @var string
     */
    protected $endDate;

    /**
     * @var int
     */
    protected $periodOfValidity;

    /**
     * @var int
     */
    protected $numberOfCities;

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
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of beginDate
     *
     * @return  string
     */ 
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set the value of beginDate
     *
     * @param  string  $beginDate
     *
     * @return  self
     */ 
    public function setBeginDate(string $beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get the value of endDate
     *
     * @return  string
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @param  string  $endDate
     *
     * @return  self
     */ 
    public function setEndDate(string $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of periodOfValidity
     *
     * @return  int
     */ 
    public function getPeriodOfValidity()
    {
        return $this->periodOfValidity;
    }

    /**
     * Set the value of periodOfValidity
     *
     * @param  int  $periodOfValidity
     *
     * @return  self
     */ 
    public function setPeriodOfValidity(int $periodOfValidity)
    {
        $this->periodOfValidity = $periodOfValidity;

        return $this;
    }

    /**
     * Get the value of numberOfCities
     *
     * @return  int
     */ 
    public function getNumberOfCities()
    {
        return $this->numberOfCities;
    }

    /**
     * Set the value of numberOfCities
     *
     * @param  int  $numberOfCities
     *
     * @return  self
     */ 
    public function setNumberOfCities(int $numberOfCities)
    {
        $this->numberOfCities = $numberOfCities;

        return $this;
    }
}