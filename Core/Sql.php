<?php

namespace App\core;

use PDO;
use App\core\Db;

abstract class Sql extends Db
{
    private $pdo;
    private $table;
    private $prefix = DBPREFIXE;

    public function __construct()
    {
        $this->pdo = Db::connect(); 
        $getCalledClass = explode('\\', strtolower(get_called_class())); 
        $this->table = $this->prefix . end($getCalledClass);
    }

    protected function persist(): void
    {
        $colums = get_object_vars($this); 
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

    public function findOneBy($entrie)
    {
        $val = [];
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . array_keys($entrie)[0] . '=:' . array_keys($entrie)[0];
        $queryPrp = $this->pdo->prepareResquest($sql, $entrie);
        while ($row = $queryPrp->fetchObject(get_called_class())) {
            array_push($val, $row);
        }
        return $val;
    }

    public function findBy($entrie)
    {
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
        while ($row = $queryPrp->fetchObject(get_called_class())) {
            array_push($val, $row);
        }
        return $val;
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $queryPrp = $this->pdo->prepareResquest($sql);

        return $queryPrp->fetchAll(PDO::FETCH_ASSOC);
    }
}