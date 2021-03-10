<?php

namespace App\controllers;

use App\entities\User;
use App\main\App;
use App\repositories\UserRepository;
use App\services\UserService;

class UserController extends Controller
{
    protected $defaultAction = 'all';

    public function allAction()
    {
        return $this->render('users', [
            'users' => App::call()->userRepository->getAll(),
            'title' => 'Все пользователи'
        ]);
    }

    public function oneAction()
    {
        return $this->render('user', [
            'user' => App::call()->userRepository->getOne($this->getId()),
            'title' => 'Name'
        ]);
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            App::call()->userService->fillUser($this->request->post());
            return header('Location: ?c=user');
        }

        return $this->render('userAdd');
    }

    public function updateAction()
    {
        if (empty($this->getId())) {
            return header('Location: /user');
        }

        $user = App::call()->userRepository->getOne($this->getId());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            App::call()->userService->fillUser($this->request->post(), $user);
            return header('Location: /user');
        }

        return $this->render('userUpdate', ['user' => $user]);
    }
}