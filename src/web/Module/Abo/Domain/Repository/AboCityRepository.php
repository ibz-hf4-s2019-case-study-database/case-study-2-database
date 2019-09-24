<?php

namespace MarkusGehrig\Abo\Domain\Repository;

class AboCityRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', '"cityId"', '"aboId"')
            ->from('"aboCity"')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Abo\Domain\Model\AboCityModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', '"cityId"', '"aboId"')
            ->from('"aboCity"')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Abo\Domain\Model\AboCityModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Abo\Domain\Model\AboCityModel');
    }

    public function insertRecord(\MarkusGehrig\Abo\Domain\Model\AboCityModel $aboCity) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('"aboCity"')
            ->values(
                array(
                    '"cityId"' => $queryBuilder->createNamedParameter($aboCity->getCityId()), 
                    '"aboId"' => $queryBuilder->createNamedParameter($aboCity->getAboId()), 
                )
            )
            ->execute();
    }
}