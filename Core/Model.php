<?php

namespace Core;

use stdClass;

class Model {

    protected $table;

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    protected function runQuery($conditions, $bindings)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $conditions");
        $stmt->execute($bindings);
        $rows = $stmt->fetchAll();

        // If query found no rows, convert it to null
        if ($rows === false) {
            $rows = null;
        } else {
            $rows = $this->formatDatabaseData($rows);
        }

        return $rows;
    }

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $object = new stdClass();
            foreach ($row as $key => $value)
            {
                $object->$key = $value;
            }
            return $object;
        }, $rows);
    }

    public static function fetchById($id)
    {
        return (new static)->runQuery('id = :id', ['id' => $id]);
    }

    public static function select($conditions)
    {
        $conditionStrings = array_map(function ($c) {
            return "{$c[0]} {$c[1]} ?";
        }, $conditions);

        return (new static)->runQuery(join(' AND ', $conditionStrings), array_column($conditions, 2));
    }
}