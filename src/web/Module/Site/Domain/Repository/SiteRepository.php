<?php

namespace MarkusGehrig\Site\Domain\Repository;

class SiteRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Site\Domain\Model\SiteModel');
    }

    public function insertRecord(\MarkusGehrig\Site\Domain\Model\SiteModel $Site) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('"site"')
            ->values(
                array(
                    '"width"' => $queryBuilder->createNamedParameter($Site->getWidth()),
                    '"length"' => $queryBuilder->createNamedParameter($Site->getLength()),
                    '"cityId"' => $queryBuilder->createNamedParameter($Site->getCityId()),
                )
            )
            ->execute();
    }

    public function findByCityId($cityId) {
        $return = [];
        $queryBuilder = $this->conn->createQueryBuilder();
        $result = $queryBuilder
            ->select('uid', '"cityId"', 'length', 'width')
            ->from('site')
            ->where($queryBuilder->expr()->eq('"cityId"', $queryBuilder->createNamedParameter($cityId)))
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Site\Domain\Model\SiteModel');
        }

        return $return;
    }
}

