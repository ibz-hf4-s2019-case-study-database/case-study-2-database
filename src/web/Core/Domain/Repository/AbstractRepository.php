<?php

namespace MarkusGehrig\Core\Domain\Repository;

class AbstractRepository {
    protected $conn;

    public function __construct() {
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = $GLOBALS['configuration']['db'];
        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }

    protected function dynamicModelCreate($data, $modelname) {
        $object = new $modelname; 
        foreach ($data as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($object, $methode) && $value !== null) {          
                $object->$methode($value);
            }
        }
        return $object;
    }
}