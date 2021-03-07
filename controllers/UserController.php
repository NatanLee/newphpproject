<?php

namespace App\controllers;

use App\modules\User;

class UserController extends Controller
{
    protected $defaultAction = 'all';

    public function allAction()
    {
        $users = (new User())->getAll();
        return $this->render('users', ['users' => $users]);
    }

    public function oneAction()
    {
        $oUser = new User;
        $user = $oUser->getOne($_GET['id']);

        return $this->render('user', [
            'user' => $user,
            'title' => 'Name'
        ]);
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->login = $_POST['login'];
            $user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $user->save();
            return header('Location: ?c=user');
        }
        return $this->render('userAdd');
    }

    public function updateAction()
    {
        if (empty($_GET['id'])) {
            return header('Location: ?c=user');
        }

        $user = (new User())->getOne($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->login = $_POST['login'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->save();
            return header('Location: ?c=user');
        }
        return $this->render('userUpdate', ['user' => $user]);
    }
}