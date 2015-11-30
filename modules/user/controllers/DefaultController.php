<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        dump(111);
        return $this->render('index');
    }
}
