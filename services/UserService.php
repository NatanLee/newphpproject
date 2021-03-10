<?php

namespace App\services;

use App\entities\User;
use App\main\App;

class UserService
{
    public function fillUser($params, $user = null)
    {
        if ($this->hasErrors($params)) {
            return [
                'msg' => 'Нет данных',
                'success' => false,
            ];
        }

        if (empty($user)) {
            $user = new User();
        }

        $user->login = $params['login'];
        $user->password = password_hash($params['password'],PASSWORD_DEFAULT);

        App::call()->userRepository->save($user);

        return [
            'msg' => 'Пользователь сохранен',
            'success' => true,
        ];
    }

    protected function hasErrors($params)
    {
        if (empty($params['login']) || empty($params['password'])) {
            return true;
        }

        return false;
    }
}