<?php

namespace MarkusGehrig\Abo\Domain\Repository;

class OfferRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', 'title', 'description', 'price', '"beginDate"', '"endDate"', '"periodOfValidity"', '"numberOfCities"')
            ->from('offer')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Abo\Domain\Model\OfferModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', 'title', 'description', 'price', '"beginDate"', '"endDate"', '"periodOfValidity"', '"numberOfCities"')
            ->from('offer')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Abo\Domain\Model\OfferModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Abo\Domain\Model\OfferModel');
    }

    public function insertRecord(\MarkusGehrig\Abo\Domain\Model\OfferModel $offer) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('offer')
            ->values(
                array(
                    'title' => $queryBuilder->createNamedParameter($offer->getTitle()), 
                    'description' => $queryBuilder->createNamedParameter($offer->getDescription()), 
                    'price' => $queryBuilder->createNamedParameter($offer->getPrice()), 
                    '"beginDate"' => $queryBuilder->createNamedParameter($offer->getBeginDate()), 
                    '"endDate"' => $queryBuilder->createNamedParameter($offer->getEndDate()), 
                    '"periodOfValidity"' => $queryBuilder->createNamedParameter($offer->getPeriodOfValidity()),
                    '"numberOfCities"' => $queryBuilder->createNamedParameter($offer->getNumberOfCities())
                )
            )
            ->execute();
    }
}

