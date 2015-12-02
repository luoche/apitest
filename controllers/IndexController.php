<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

use app\controllers\Base;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\BaseMessage;
use app\models\PostParam;
use app\models\ReturnParam;
use app\models\ReturnCode;
use app\models\ErrorMessage;
use app\models\Code;

use yii\helpers\ArrayHelper;

class IndexController extends BaseController
{
    
    
    public $layout = false;
    public $enableCsrfValidation = false;
    // public $cid;
    public function init()
    {
        parent::init();
        $request  = Yii::$app->request;
        $userHost = Yii::$app->request->userHost;
        $userIP   = Yii::$app->request->userIP;
    }
    public function actionIndex()
    {

        $base_message = new BaseMessage();
        $code         = new Code();
        $category = ['action_url'=>Url::toRoute(['category/ajax-create']),'tableName'=>'Category'];
        $base_message = ['action_url'=>Url::toRoute(['base-message/ajax-add']),'tableName'=>'BaseMessage','info_url'=>Url::toRoute(['base-message/ajax-add-all'])];
        // \Yii::$app->clientScript()->registerCoreScript('jquery');
        return $this->render('index',['BaseMessage'=>$base_message,'category'=>$category]);
    }













    public function actionPost($cid=0)
    {
        $data = [];
        $cid  = intval(ArrayHelper::getValue(Yii::$app->request->get(),'cid',0));
        //findmodel 验证
        $post_model = new PostParam(); 
        return $this->render('post',['data'=>$data,'model'=>$post_model,'cid'=>$cid]);
    }

    public function actionReturnParam($cid=0)
    {
        $data = [];
        $cid = intval(ArrayHelper::getValue(Yii::$app->request->get(),'cid',0));
        $return_model = new ReturnParam();
        return $this->render('return-param',['data'=>$data,'model'=>$return_model,'cid'=>$cid]);
    }

    public function actionReturnCode($cid=0)
    {
        $data = [];
        $cid = intval(ArrayHelper::getValue(Yii::$app->request->get(),'cid',0));
        $code_model = new ReturnCode();
        return $this->render('return-code',['data'=>$data,'model'=>$code_model,'cid'=>$cid]);
    }
    public function actionErrorMsg($cid=0)
    {
        $data = [];
        $cid = intval(ArrayHelper::getValue(Yii::$app->request->get(),'cid',0));
        $error_msg = new ErrorMessage();
        return $this->render('error-msg',['data'=>$data,'model'=>$error_msg,'cid'=>$cid]);
    }

    public function actionAjaxBaseMessage()
    {
        $base_message = new BaseMessage();
        $request = Yii::$app->request;
        if ($request->isPost) {
            $post = $request->post();
            if ($base_message->load($post)) {
                $base_message->status = 1;
                $base_message->sort = 1;
                if (empty($post['BaseMessage']['tag'])) {
                    $base_message->tag = 'default';
                }
                $base_message->role_apply_level = 1;
                $base_message->save();
                return $this->redirect(['post','cid'=>$base_message->id]);
            } else {
                return $this->render('index',['base_message'=>$base_message]);
            }
            //验证加保存
            
        }
    }
   
    public function actionAjaxPost()
    {
        $request = Yii::$app->request;
        dump($request->post());
        $type    = ArrayHelper::getValue($request->get(),'type','');
        $cid     = ArrayHelper::getValue($request->get(),'cid',0);
        if (!empty($type) && 'next' == $type) {//跳过传递参数
            dump($cid);
            return $this->redirect(['return-param','cid'=>$cid]);
        } else {
            echo '222';
        }
    }

    public function actionAjaxReturn()
    {
        $request = Yii::$app->request;
        dump($request->post());
        $type    = ArrayHelper::getValue($request->get(),'type','');
        $cid     = ArrayHelper::getValue($request->get(),'cid',0);
        if (!empty($type) && 'next' == $type) {//跳过传递参数
            dump($cid);
            return $this->redirect(['return-code','cid'=>$cid]);
        } else {
            echo '222';
        }
    }
    public function actionAjaxCode()
    {
        $request = Yii::$app->request;
        dump($request->post());
        $type    = ArrayHelper::getValue($request->get(),'type','');
        $cid     = ArrayHelper::getValue($request->get(),'cid',0);
        if (!empty($type) && 'next' == $type) {//跳过传递参数
            dump($cid);
            return $this->redirect(['error-msg','cid'=>$cid]);
        } else {
            echo '222';
        }
    }
    public function findModel()
    {
       
    }
}
