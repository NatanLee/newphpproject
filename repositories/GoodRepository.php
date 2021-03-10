<?php

namespace App\repositories;


use App\entities\Good;
use App\entities\User;

class GoodRepository extends Repository
{

    public function getTableName(): string
    {
        return 'goods';
    }

    public function getEntityClass(): string
    {
        return Good::class;
    }
}