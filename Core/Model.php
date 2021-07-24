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

    protected function runQuery($query, $bindings): array
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        $rows = $stmt->fetchAll();

        // If query found no rows, convert it to null
        if ($rows == false) {
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

    public static function fetchById($id): array
    {
        return (new static)->runQuery('id = :id', ['id' => $id]);
    }

    public static function select($conditions): array
    {
        $conditionStrings = array_map(function ($c) {
            return "{$c[0]} {$c[1]} ?";
        }, $conditions);

        return (new static)->runQuery(
            'SELECT * FROM ' . self::$table .  ' WHERE ' . join(' AND ', $conditionStrings),
            array_column($conditions, 2)
        );
    }

    public static function create($parameters): string
    {
        $table = (new static)->table;
        $columns = join(', ', array_keys($parameters));
        $wildcards = join(', ', array_fill(0, count($parameters), '?'));

        (new static)->runQuery(
            "INSERT INTO $table ($columns) VALUES ($wildcards)",
            array_values($parameters)
        );

        return (new static)->db->lastInsertId();
    }
}