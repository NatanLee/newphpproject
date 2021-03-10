<?php

namespace App\controllers;


class Admin extends Controller
{
    public function run($action)
    {
        if (empty($_SESSION['role'])) {
            return header('Location: /auth');
        }

        return parent::run($action);
    }
}