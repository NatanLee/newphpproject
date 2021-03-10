<?php

namespace App\repositories;


use App\entities\User;

class UserRepository extends Repository
{
    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    public function getTableName(): string
    {
        return 'users';
    }

    /**
     * Возвращает имя сущности
     * @return string
     */
    public function getEntityClass(): string
    {
        return User::class;
    }
}