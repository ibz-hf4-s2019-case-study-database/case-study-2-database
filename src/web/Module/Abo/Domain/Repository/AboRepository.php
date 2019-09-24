<?php

namespace MarkusGehrig\Abo\Domain\Repository;

class AboRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', '"companyId"', '"offerId"', '"beginDate"', '"endDate"')
            ->from('abo')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Abo\Domain\Model\AboModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', '"companyId"', '"offerId"', '"beginDate"', '"endDate"')
            ->from('abo')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Abo\Domain\Model\AboModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Abo\Domain\Model\AboModel');
    }

    public function insertRecord(\MarkusGehrig\Abo\Domain\Model\AboModel $abo) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('abo')
            ->values(
                array(
                    '"companyId"' => $queryBuilder->createNamedParameter($abo->getCompanyId()), 
                    '"offerId"' => $queryBuilder->createNamedParameter($abo->getOfferId()), 
                    '"beginDate"' => $queryBuilder->createNamedParameter($abo->getBeginDate()), 
                    '"endDate"' => $queryBuilder->createNamedParameter($abo->getEndDate())
                )
            )
            ->execute();
        
        return $queryBuilder->getConnection()->lastInsertId();
    }
}

