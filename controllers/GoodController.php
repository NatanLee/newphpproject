<?php

namespace App\controllers;

use App\modules\Good;

class GoodController extends Controller
{
    protected $defaultAction = 'all';

    public function allAction()
    {
        $users = (new Good())->getAll();
        return $this->render('goods', ['goods' => $users]);
    }

    public function oneAction()
    {
        $oUser = new Good();
        $user = $oUser->getOne($_GET['id']);

        return $this->render('good', [
            'good' => $user,
            'title' => 'Name'
        ]);
    }
}