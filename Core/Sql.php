<?php

namespace App\Core;

use PDO;
use App\core\Db;
use App\Models\User;

class Sql extends Db
{
    private $pdo;
    private $table;

    public function __construct()
    {
        $this->pdo = Db::connect(); 
        $getCalledClass = explode('\\', strtolower(get_called_class())); 
        $this->table = str_replace('repository', '', end($getCalledClass));
    }
 
    protected function save(Object $class): void
    {
        $colums = get_object_vars($class); 
        $varToExplode = get_class_vars(get_class()); 
        $colums = array_diff_key($colums, $varToExplode); 

        if ($colums['id'] == null) {
            $colums = array_diff($colums, [$colums['id']]);
            $sql = 'INSERT INTO ' . $this->table  . ' (' . implode(',', array_keys($colums)) . ') VALUES (:' . implode(',:', array_keys($colums)) . ')';
        } else {
            $update = [];
            foreach ($colums as $key => $value) {
                $update[] = $key . '=:' . $key;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(',', $update) . " WHERE id=:id";
        }
        $this->pdo->prepareResquest($sql, $colums);
    }

    public function getOneBy(array $criterias)
    {
        $class = "App\\Models\\" . ucfirst($this->table);
        $val = [];
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . array_keys($criterias)[0] . '=:' . array_keys($criterias)[0];
        $queryPrp = $this->pdo->prepareResquest($sql, $criterias);
        while ($row = $queryPrp->fetch(PDO::FETCH_ASSOC)) {
                array_push($val, $row);
        }

        $object = new $class();
        foreach($val[0] as $key => $property){
            $object->{"set" . ucfirst($key)}($property);
        }
        return $object;
    }

    public function getBy(array $entrie)
    {
        $class = "App\\Models\\" . ucfirst($this->table);
        $val = [];
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';
        foreach ($entrie as $key => $data) {
            if (end($entrie) != $data) {
                $sql .= $key . '=:' . $key . ' and ';
            } else {
                $sql .= $key . '=:' . $key;
            }
        }
        $queryPrp = $this->pdo->prepareResquest($sql, $entrie);

        foreach($queryPrp->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $object = new $class();
            foreach($row as $key => $property){
                $object->{"set" . ucfirst($key)}($property);
            }
            $val[] = $object;
        }
        return $val;
    }

    public function getAll()
    {
        $class = "App\\Models\\" . ucfirst($this->table);
        $val = [];
        $sql = 'SELECT * FROM ' . $this->table;
        $queryPrp = $this->pdo->prepareResquest($sql);

        foreach($queryPrp->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $object = new $class();
            foreach($row as $key => $property){
                $object->{"set" . ucfirst($key)}($property);
            }
            $val[] = $object;
        }
        return $val;
    }
}