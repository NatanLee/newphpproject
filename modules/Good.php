<?php
namespace App\modules;

class Good extends Model
{
    public $id;
    public $name;
    public $info;

    public function filling($params)
    {

    }

    public function getData()
    {
        $data = [];
        foreach ($this as $property => $value) {
            if ($property == 'bd') {
                continue;
            }

            //$this->$property = $params[$value]

            $data[$property] = $value;
        }

        var_dump($data);
    }

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    public function getTableName(): string
    {
        return 'goods';
    }


}