<?php

namespace App\controllers;

class AuthController extends Controller
{
    protected $defaultAction = 'login';

    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['role'] = 1;
            return header('Location: /admin');
        }

        return $this->render->render('login');
    }

    public function logoutAction()
    {
        unset($_SESSION['role']);
        return header('Location: /');
    }

}
