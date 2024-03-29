<?php

namespace MarkusGehrig\Site\Domain\Repository;

class CityRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', 'name', 'zip', 'address')
            ->from('city')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Site\Domain\Model\CityModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', 'name', 'zip', 'address')
            ->from('city')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Site\Domain\Model\CityModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Site\Domain\Model\CityModel');
    }

    public function insertRecord(\MarkusGehrig\Site\Domain\Model\CityModel $city) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('city')
            ->values(
                array(
                    'name' => $queryBuilder->createNamedParameter($city->getName()),
                    'zip' => $queryBuilder->createNamedParameter($city->getZip()),
                    'address' => $queryBuilder->createNamedParameter($city->getAddress())
                )
            )
            ->execute();
    }
}

