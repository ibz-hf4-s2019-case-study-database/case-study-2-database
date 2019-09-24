<?php

namespace MarkusGehrig\Site\Domain\Repository;

class DateRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', '"date"', '"cityId"')
            ->from('"date"')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Site\Domain\Model\DateModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', 'date', '"cityId"')
            ->from('date')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Site\Domain\Model\DateModel');  
    }

    public function findByCityId(int $cityId) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', 'date', '"cityId"')
            ->from('date')
            ->where($queryBuilder->expr()->eq('"cityId"', $queryBuilder->createNamedParameter($cityId)))
            ->execute()
            ->fetchAll();

        
        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Site\Domain\Model\DateModel');
        }

        return $return;  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Site\Domain\Model\DateModel');
    }

    public function insertRecord(\MarkusGehrig\Site\Domain\Model\DateModel $Date) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('"date"')
            ->values(
                array(
                    '"date"' => $queryBuilder->createNamedParameter($Date->getDate()),
                    '"cityId"' => $queryBuilder->createNamedParameter($Date->getCityId()),
                )
            )
            ->execute();
    }
}

