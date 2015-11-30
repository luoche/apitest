<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;

class BaseController extends Controller
{
    
    
    public $layout = "user";

    public function actionIndex()
    {
        $request = Yii::$app->request;

        // 返回所有参数
        // $params = $request->bodyParams;
        echo "<br/><br/>";
        // 返回参数 "id"
        // 
        $userHost = Yii::$app->request->userHost;
        $userIP   = Yii::$app->request->userIP;
        // dump($userHost);
        // dump($userIP);
        $param = $request->getBodyParam('id');


        // dump(Yii::$app->request);
        // dump($basePath);
        // exit;
        // \Yii::$app->clientScript()->registerCoreScript('jquery');
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * 通用的調取分頁獲取數據包含排序
     * @dates  2015-11-16
     * @author wangyafei
     * @param  string     $query  查詢對象
     * @param  array      $config 配置数组
     * @return array              [description]
     */
    public function  getPagedRows($query,$config=[])
    {
        $countQuery = clone $query;
        $pages=new Pagination(['totalCount' => $countQuery->count()]);
        if(isset($config['pageSize']))
        {
                $pages->setPageSize($config['pageSize'],true);
        }

        $rows = $query->offset($pages->offset)->limit($pages->limit);
        if(isset($config['order']))
        {
                $rows = $rows->orderBy($config['order']);
        }
        $rows = $rows->all();


        $rowsLable='rows';
        $pagesLable='pages';

        if(isset($config['rows']))
        {
                $rowsLable=$config['rows'];
        }
        if(isset($config['pages']))
        {
                $pagesLable=$config['pages'];
        }

        $ret=[];
        $ret[$rowsLable]=$rows;
        $ret[$pagesLable]=$pages;

        return $ret;
    }
}
