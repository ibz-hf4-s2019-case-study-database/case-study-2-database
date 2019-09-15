<?php

namespace MarkusGehrig\Company\Domain\Repository;

class CompanyRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', 'name', 'telephone')
            ->from('company')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\Company\Domain\Model\CompanyModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', 'name', 'telephone')
            ->from('company')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($result, '\MarkusGehrig\Company\Domain\Model\CompanyModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\Company\Domain\Model\CompanyModel');
    }

    public function insertRecord(\MarkusGehrig\Company\Domain\Model\CompanyModel $company) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('company')
            ->values(
                array(
                    'name' => $queryBuilder->createNamedParameter($company->getName()),
                    'telephone' => $queryBuilder->createNamedParameter($company->getTelephone()),
                )
            )
            ->execute();
    }
}

