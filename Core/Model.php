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

    public function runQuery($query, $bindings, $returnRowCount = false)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);

        if ($returnRowCount) {
            return $stmt->rowCount();
        }

        $rows = $stmt->fetchAll();

        // If query found no rows, convert it to null
        if ($rows === false) {
            $rows = [];
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

    public static function fetchById($id): ?Model
    {
        return self::select([['id', '=', $id]])[0] ?? null;
    }

    public static function select($conditions): array
    {
        $table = (new static)->table;
        $conditionString = join(
            ' AND ',
            array_map(function ($c) {
                $placeholder = '?';
                // If binding column is an array, we have to patch a string of named parameters
                if (is_array($c[2])) {
                    $placeholder = '(' . str_repeat('?,', count($c[2]) - 1) . '?)';
                }
                return "$c[0] $c[1] $placeholder";
            }, $conditions)
        );
        return (new static)->runQuery(
            "SELECT * FROM $table WHERE $conditionString",
            Helpers::array_flatten(array_column($conditions, 2))
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

    public static function update($id, $parameters): bool
    {
        $table = (new static)->table;
        $columns = join(' = ?, ', array_keys($parameters)) . ' = ?';
        $updateCount = (new static)->runQuery(
            "UPDATE $table SET $columns WHERE id = ?",
            array_merge(array_values($parameters), [$id]),
            true
        );

        return $updateCount === 1;
    }

    public static function delete($id): bool
    {
        $table = (new static)->table;

        $deleteCount = (new static)->runQuery("DELETE FROM $table WHERE id = ?", [$id], true);
        return $deleteCount === 1;
    }
}