<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;

class UserController extends Controller
{
    
    
    public $layout = "user";

    public function actionIndex()
    {
        $request = Yii::$app->request;

        // 返回所有参数
        // $params = $request->bodyParams;
        echo "<br/><br/>";
        // dump($request->url);
        // dump($request->getPreferredLanguage());
        // dump($request->absoluteUrl);
        // dump($request->hostInfo);
        // dump($request->pathInfo);
        // dump($request->queryString);
        // dump($request->absoluteUrl);
        // dump($request);
        // dump($params);
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

    public function  actionTestCookie()
    {

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'name',
            'value'=>'test again'
        ]));

    }

    
    public function  actionTestSession()
    {

        $session = Yii::$app->session;

        $session->setFlash('postDeleted', 'You have successfully deleted your post.');
    }

    public function  actionTestSessionUse()
    {
        $session = Yii::$app->session;

        echo $session->getFlash('postDeleted');
    }
    public function  actionTestHello()
    {
        echo "hello";
        exit;
    }

    public function  actionModelTest()
    {
        $article = new Article();
        $article->name = "test1";
        $article->title = "hello";
        $article->content = "content1";
        $article->status = "1";
        $article->save(); 
    }

    public function  actionUpdateTest()
    {

        $query = Article::find()
          ->where(['id'=>[1,2,3,4]])
          ->select(['name']);

        // get the AR raw sql in YII2
        $commandQuery = $query;
        echo $commandQuery->createCommand()->getRawSql();

        $users = $query->all();

        /*$article = Article::findOne(1);
        // dump($article);
        // dump($article->status);
        $article->name = "test1";
        $article->title = "hello";
        $article->content = "content2";
        $article->status = "1";
        $query = $article->save();

        echo $article->find()->createCommand()->getRawSql();*/
        // $commandQuery = $query;
        // echo $commandQuery->createCommand()->getRawSql();
    }

    public function  actionSelect()
    {
        $query = Article::find()->select(['id','name'])->where(['id'=>1]);

    }
}
