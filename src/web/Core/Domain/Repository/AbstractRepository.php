<?php

namespace MarkusGehrig\Core\Domain\Repository;

class AbstractRepository {
    protected $conn;

    public function __construct() {
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'dbname' => 'market',
            'user' => 'postgres',
            'password' => 'Weltderwunder',
            'host' => '172.21.0.3',
            'driver' => 'pdo_pgsql',
        );
        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }

    protected function dynamicModelCreate($data, $modelname) {
        $object = new $modelname; 
        foreach ($data as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($object, $methode)) {          
                $object->$methode($value);
            }
        }
        return $object;
    }
}