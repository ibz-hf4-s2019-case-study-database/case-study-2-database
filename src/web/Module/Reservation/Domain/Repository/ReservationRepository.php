<?php

namespace MarkusGehrig\Reservation\Domain\Repository;

class ReservationRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', '"companyId"', '"cityId"', '"dateId"', '"siteId"')
            ->from('reservation')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Reservation\Domain\Model\ReservationModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', '"companyId"', '"cityId"', '"dateId"', '"siteId"')
            ->from('reservation')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Reservation\Domain\Model\ReservationModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Reservation\Domain\Model\ReservationModel');
    }

    public function insertRecord(\MarkusGehrig\Reservation\Domain\Model\ReservationModel $reservation) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('reservation')
            ->values(
                array(
                    '"companyId"' => $queryBuilder->createNamedParameter($reservation->getCompanyId()), 
                    '"cityId"' => $queryBuilder->createNamedParameter($reservation->getCityId()), 
                    '"dateId"' => $queryBuilder->createNamedParameter($reservation->getDateId()), 
                    '"siteId"' => $queryBuilder->createNamedParameter($reservation->getSiteId())
                )
            )
            ->execute();
    }
}