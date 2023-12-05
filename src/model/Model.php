<?php

// Gebaseerd op: http://codetuto.com/2013/07/creating-a-php-website-using-mvc-4-creating-model-class/
namespace Acme\model;

use Acme\system\Database;
use PDO;

/**
 * Model base class
 */
class Model
{

    protected static string $tableName = '';
    protected static string $primaryKey = '';
    protected array $columns;
    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setColumnValue($column, $value)
    {
        $this->columns[$column] = $value;
    }

    public function getColumnValue($column)
    {
        return $this->columns[$column];
    }

    /**
     * Save or update the item data in database
     */
    public function save(): int
    {
        $query = "REPLACE INTO " . static::$tableName . " (" . implode(
                ",",
                array_keys(
                    $this->columns
                )
            ) . ") VALUES(";
        $keys = array();
        foreach ($this->columns as $key => $value) {
            $keys[":" . $key] = $value;
        }
        $query .= implode(",", array_keys($keys)) . ")";
        $s = $this->db->getPreparedStatement($query);
        $s->execute($keys);
        return $this->db->lastInsertId();
    }

    /**
     * Delete item
     */
    public function delete($id)
    {
        $query = "DELETE FROM " . static::$tableName . " WHERE "
            . static::$primaryKey . "=:id LIMIT 1";
        $s = $this->db->getPreparedStatement($query);
        $s->execute(array(':id' => $id));
    }

    /**
     * Create an instance of this Model from the database row
     */
    private function createFromDb($column)
    {
        foreach ($column as $key => $value) {
            $this->columns[$key] = $value;
        }
    }

    /**
     * Get all items
     * Conditions are combined by logical AND
     *
     * @example getAll(array(name=>'Bond',job=>'artist'),'age DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND job='artist' ORDER BY age DESC LIMIT 0,25
     */
    public function getAll(
        $condition = array(),
        $order = null,
        $startIndex = null,
        $count = null
    ) {
        $query = "SELECT * FROM " . static::$tableName;
        if ( ! empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($startIndex !== null) {
            $query .= " LIMIT " . $startIndex;
            if ($count) {
                $query .= "," . $count;
            }
        }
        return $this->get($query, $condition);
    }

    /**
     * Pass a custom query and condition
     *
     * @example get('SELECT * FROM TABLE WHERE name=:user OR age<:age',array(name=>'Bond',age=>25))
     */
    public function get($query, $condition = array())
    {
        $s = $this->db->getPreparedStatement($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $result = $s->fetchAll(PDO::FETCH_ASSOC);
        $collection = array();
        $className = get_called_class();
        foreach ($result as $row) {
            $item = new $className();
            $item->createFromDb($row);
            array_push($collection, $item);
        }
        return $collection;
    }

    /**
     * Get a single item
     */
    public function getOne(
        $condition = array(),
        $order = null,
        $startIndex = null
    ) {
        $query = "SELECT * FROM " . static::$tableName;
        if ( ! empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($startIndex !== null) {
            $query .= " LIMIT " . $startIndex . ",1";
        }
        $s = $this->db->getPreparedStatement($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $row = $s->fetch(PDO::FETCH_ASSOC);
        $className = get_called_class();
        $item = new $className();
        $item->createFromDb($row);
        return $item;
    }

    /**
     * Get an item by the primarykey
     */
    public function getByPrimaryKey($value)
    {
        $condition = array();
        $condition[static::$primaryKey] = $value;
        return $this->getOne($condition);
    }

    /**
     * Get the number of items
     */
    public function getCount($condition = array()): int
    {
        $query = "SELECT COUNT(*) FROM " . static::$tableName;
        if ( ! empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        $s = $this->db->getPreparedStatement($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $countArr = $s->fetch();
        return $countArr[0];
    }

}