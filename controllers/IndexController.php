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
use app\models\Category;
use app\models\Code;

use yii\helpers\ArrayHelper;

class IndexController extends BaseController
{
    
    
    public $layout = false;
    public $enableCsrfValidation = false;
    public $apiHost;
    public function init()
    {
        parent::init();
        $this->apiHost = '192.168.1.40/seeed-cc/api/index.php?r=';
        $request  = Yii::$app->request;
        $userHost = Yii::$app->request->userHost;
        $userIP   = Yii::$app->request->userIP;
    }
    public function actionIndex()
    {
        $category     = ['action_url'=>Url::toRoute(['category/ajax-create']),'tableName'=>'Category'];
        $base_message = ['action_url'=>Url::toRoute(['base-message/ajax-add']),'tableName'=>'BaseMessage','info_url'=>Url::toRoute(['base-message/ajax-add-all'])];
        return $this->render('index',['BaseMessage'=>$base_message,'category'=>$category,'apiHost'=>$this->apiHost]);
    }


    public function actionApiDetail($id=1)
    {
        $request  = Yii::$app->request;
        $id       = ArrayHelper::getValue($request->get(),'id',1);
        $all_info = $this->getApiDetail($id);
        return $this->render('view',['base_message'=>$all_info['base_message'],'post_param'=>$all_info['post_param'],'return_param'=>$all_info['return_param'],'return_code'=>$all_info['return_code'],'error_msg'=>$all_info['error_msg']]);
    }

    public function actionApiEdit($id=1)
    {
        $request  = Yii::$app->request;
        $id       = ArrayHelper::getValue($request->get(),'id',1);
        $all_info = $this->getApiDetail($id);
        $action   = ['action'=>Url::toRoute(['base-message/ajax-api-edit']),'tableName'=>''];
        return $this->render('edit',['base_message'=>$all_info['base_message'],'post_param'=>$all_info['post_param'],'return_param'=>$all_info['return_param'],'return_code'=>$all_info['return_code'],'error_msg'=>$all_info['error_msg'],'action'=>$action]);
    }


    public function getApiDetail($id)
    {
        $base_message = BaseMessage::find()->where(['status'=>1,'id'=>$id])->limit(1)->asArray()->one();
        $post_param   = PostParam::find()->where(['status'=>1,'b_id'=>$id])->asArray()->all();
        $return_param = ReturnParam::find()->where(['status'=>1,'b_id'=>$id])->asArray()->all();
        $return_code  = ReturnCode::find()->where(['status'=>1,'b_id'=>$id])->asArray()->limit(1)->one();
        $error_msg    = ErrorMessage::find()->where(['status'=>1,'b_id'=>$id])->asArray()->all();
        return ['base_message'=>$base_message,'post_param'=>$post_param,'return_param'=>$return_param,'return_code'=>$return_code,'error_msg'=>$error_msg];
    }

    public function actionList()
    {
        $cateLst = Category::getAllCategory();
        $data = ['cateLst'=>$cateLst];
        return $this->render('list',['data'=>$data,'cate_url'=>Url::toRoute(['index/api-cate']),'url'=>Url::toRoute(['index/index']),'apiHost'=>$this->apiHost]);
    }
    public function actionApiList()
    {
        $request = Yii::$app->request;
        $like   = ArrayHelper::getValue($request->post(),'search');
        //先在C层写 再在M层写
        // $like   = '2';
        $query  = BaseMessage::find();
        if (!empty($like)) {
            $query->andFilterWhere(['like','name',$like])
                ->orFilterWhere(['like','url',$like]);
        }
        $query->andFilterWhere(['status'=>BaseMessage::STATUS_ACTIVE]);
        $command = $query->createCommand();
        $return  = $this->apiCommonLst($command);
        return $this->render('list-content',['data'=>$return,'apiHost'=>$this->apiHost]);
    }


    public function actionApiCate()
    {
        // $cate = 22;
        $request = Yii::$app->request;
        $like = ArrayHelper::getValue($request->post(),'search');
        $cate = ArrayHelper::getValue($request->get(),'cate');
        if (empty($cate)) {
            return $this->redirect(Url::toRoute(['index/api-list']));
        }
        $query= BaseMessage::find();
        if (!empty($like)) {
            $query->andFilterWhere(['like','name',$like])
                ->orFilterWhere(['like','url',$like]);
        }
        $query->andFilterWhere(['cate'=>$cate])
              ->andFilterWhere(['status'=>BaseMessage::STATUS_ACTIVE]);
        $command = $query->createCommand();
        // echo $command->sql;
        $return  = $this->apiCommonLst($command);
        // dump($return);
        // dump($command->params);
        $url = ['view_url'=>Url::toRoute(['index/api-detail']),'edit_url'=>Url::toRoute(['index/api-edit'])];
        /*if (!empty($request->isPost)) {
            dump(111);
            echo json_encode(['url'=>'www.baidu.com']); exit;
        }*/
        return $this->render('list-content',['data'=>$return,'url'=>$url,'post_url'=>Url::toRoute(['index/api-cate']),'apiHost'=>$this->apiHost]);
    }

    /**
     * 根据查询条件返回数据
     * @dates  2015-12-03
     * @author wangyafei
     * @param  object     $command  操作对象
     * @return array                处理过的数组
     */
    public function apiCommonLst($command)
    {
        // echo $command->sql;
        $rows = $command->queryAll();
        // dump($rows);
        return $rows;
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
   
    
    public function findModel()
    {
       
    }
}
