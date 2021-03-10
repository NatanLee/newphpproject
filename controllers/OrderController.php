<?php

namespace App\controllers;

use App\main\App;
use App\modules\Good;

class OrderController extends Controller
{
    protected $defaultAction = 'all';

    public function allAction()
    {
        var_dump($_SESSION);
    }

    public function addAction()
    {
        $id = $this->getId();
        $_SESSION['goods'][$id] = App::call()->goodRepository->getOne($id);
        return header('Location: /good');
    }

    public function saveAction()
    {
//        $id = $this->getId();
//        $_SESSION['goods'][$id] = App::call()->goodRepository->getOne($id);
//        return header('Location: /good');
    }
}