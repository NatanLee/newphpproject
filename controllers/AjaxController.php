<?php

namespace App\controllers;

use App\main\App;
use App\modules\Good;

class AjaxController extends Controller
{
    protected $defaultAction = 'get';

    public function getAction()
    {
        header('Content-Type: application/json');
        return json_encode([
            'success' => true,
            'count' => 2
        ]);
    }

}