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
}

