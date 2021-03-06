<?php
namespace App\modules;
/**
 * Class User
 * @package App\modules
 * @property int $id
 * @property string $login
 * @property string $password
 */
class User extends Model
{
    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    public function getTableName(): string
    {
        return 'users';
    }
}