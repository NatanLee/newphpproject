<?php
namespace App\modules;

use App\services\DB;

/**
 * Class Model
 * @property int $id
 */
abstract class Model
{
    /**
     * @var DB
     */
    protected $bd;

    public function __construct()
    {
        $this->bd = DB::getInstance();
    }

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    abstract public function getTableName(): string;

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->queryObject($sql, static::class, [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->queryObjects($sql, static::class);
    }

    protected function insert()
    {
        $columns = [];
        $params = [];
        foreach ($this as $property => $value) {
            if ($property == 'bd' || empty($value)) {
                continue;
            }
            $columns[] = $property;
            $params[":{$property}"] = $value;
        }

        $tableName = $this->getTableName();
        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));

        $sql = "INSERT INTO $tableName ($columnsString) VALUES ( $placeholders)";

        $this->bd->exec($sql, $params);
        $this->id = $this->bd->lastInsertId();
    }

    public function delete()
    {
        //DELETE FROM users WHERE id = 12
        $tableName = $this->getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        $this->bd->exec($sql, [':id' => $this->id]);
    }

    protected function update()
    {
        //UPDATE users SET
        // password = :password,
        // login = 'Sap33'
        // WHERE users.id = 12;

        $placeholders = [];
        $params = [":id" => $this->id];
        foreach ($this as $property => $value) {
            if ($property == 'bd' || $property == 'id') {
                continue;
            }
            $placeholders[] = "{$property} = :{$property}";
            $params[":{$property}"] = $value;
        }

        $tableName = $this->getTableName();
        $placeholders = implode(', ', $placeholders);

        $sql = "UPDATE {$tableName} SET  {$placeholders} WHERE id = :id;";

        $this->bd->exec($sql, $params);
    }

    public function save()
    {
        if (!$this->id) {
            $this->insert();
            return;
        }

        $this->update();
    }
}