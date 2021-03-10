<?php


namespace App\repositories;


use App\entities\Entity;
use App\main\App;
use App\services\DB;

abstract class Repository
{
    /**
     * @var DB
     */
    protected $bd;

    public function __construct()
    {
        $this->bd = App::call()->db;
    }

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Возвращает имя сущности
     * @return string
     */
    abstract public function getEntityClass(): string;

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->queryObjects($sql, $this->getEntityClass());
    }

    /**
     * @param Entity $entity
     */
    protected function insert(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $property => $value) {
            if (empty($value)) {
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
        $entity->id = $this->bd->lastInsertId();
    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        $this->bd->exec($sql, [':id' => $entity->id]);
    }

    protected function update(Entity $entity)
    {
        $placeholders = [];
        $params = [":id" => $entity->id];
        foreach ($entity as $property => $value) {
            if ($property == 'id') {
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

    public function save(Entity $entity)
    {
        if (!$entity->id) {
            $this->insert($entity);
            return;
        }

        $this->update($entity);
    }
}