<?php

namespace App\controllers;

use App\main\App;
use App\modules\Good;

class GoodController extends Controller
{
    protected $defaultAction = 'all';

    public function allAction()
    {
        return $this->render(
            'goods',
            [
                'goods' => App::call()->goodRepository->getAll()
            ]
        );
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