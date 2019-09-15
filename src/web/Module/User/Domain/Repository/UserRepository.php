<?php

namespace MarkusGehrig\User\Domain\Repository;

class UserRepository extends \MarkusGehrig\Core\Domain\Repository\AbstractRepository {
    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $queryBuilder = $this->conn->createQueryBuilder();

        $return = [];
        $result = $queryBuilder
            ->select('uid', 'username', 'firstname', 'lastname', 'street', 'zip', 'place', 'telephone', 'function', '"companyId"')
            ->from('people')
            ->execute()
            ->fetchAll();

        foreach ($result as $value) {
            $return[] = $this->dynamicModelCreate($value, '\MarkusGehrig\User\Domain\Model\UserModel');
        }

        return $return;
    }

    public function findByUid(int $uid) {
        $queryBuilder = $this->conn->createQueryBuilder();

        $result = $queryBuilder
            ->select('uid', 'username', 'firstname', 'lastname', 'street', 'zip', 'place', 'telephone', 'function', '"companyId"')
            ->from('people')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)))
            ->execute()
            ->fetch();

        
        return $this->dynamicModelCreate($value, '\MarkusGehrig\User\Domain\Model\UserModel');  
    }

    public function createModel($data) {
        return $this->dynamicModelCreate($data, '\MarkusGehrig\User\Domain\Model\UserModel');
    }

    public function insertRecord(\MarkusGehrig\User\Domain\Model\UserModel $user) {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->insert('people')
            ->values(
                array(
                    'username' => $queryBuilder->createNamedParameter($user->getUsername()),
                    'firstname' => $queryBuilder->createNamedParameter($user->getFirstname()),
                    'lastname' => $queryBuilder->createNamedParameter($user->getLastname()),
                    'street' => $queryBuilder->createNamedParameter($user->getStreet()),
                    'zip' => $queryBuilder->createNamedParameter($user->getZip()),
                    'place' => $queryBuilder->createNamedParameter($user->getPlace()),
                    'telephone' => $queryBuilder->createNamedParameter($user->getTelephone()),
                    'function' => $queryBuilder->createNamedParameter($user->getFunction()),
                    '"companyId"' => $queryBuilder->createNamedParameter($user->getCompanyId()),
                )
            )
            ->execute();
    }
}

