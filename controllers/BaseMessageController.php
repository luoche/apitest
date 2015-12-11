<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\BaseMessage;
use app\models\Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
/**
 * BaseMessageController implements the CRUD actions for baseMessage model.
 */
class BaseMessageController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all baseMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single baseMessage model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new baseMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new baseMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * baseMessage的添加
     * @dates  2015-12-01
     * @author wangyafei
     * @return json     添加结果
     */
    public function actionAjaxAdd()
    {
        $request = Yii::$app->request;
        $model   = new BaseMessage();
        $data    = $request->post();
        if ($model->load($data)) {
            $model->url      = trim($model->url);
            $model->detail   = trim($model->detail);
            $model->author   = trim($model->author);
            $model->status   = 1;
            $model->add_time = time();
            $model->sort     = 1;
            $model->tag      = 'default';
            $model->role_apply_level = 1;
            $flag = $model->save();
            if (!$flag) {
                $errors    = array_values($model->getErrors());
                $error_msg = ArrayHelper::getValue($errors[0],0);
                echo json_encode(['errorcode'=>1,'msg'=>$error_msg]);exit;
            } else {
                echo json_encode(['errorcode'=>0,'msg'=>'添加成功','data'=>['b_id'=>$model->id]]);exit;
            }
        } else {
            echo json_encode(['errorcode'=>2,'msg'=>'验证不通过']);exit;
        }
    }

    public function actionAjaxAddAll()
    {
        $request = Yii::$app->request;
        $data    = $request->post();
        $b_id    = ArrayHelper::getValue($data,'b_id',0);
        ArrayHelper::remove($data, 'b_id');
        $deal_data = $this->dealPostParam($data);
        $base_message_model = new BaseMessage();
        //在model层处理不同的数组
        $deal    = $base_message_model->addAllApiMessage($deal_data,$b_id);

        if ($deal) {
            $url = Url::toRoute(['index/index']);
            return $this->redirect($url);
        } else {
            echo json_encode(['errorcode'=>1,'msg'=>'添加失败']);exit;
        }
    }

    public function actionAjaxApiEdit()
    {
        $request = Yii::$app->request;
        $post    = $request->post();
        $base_message = ArrayHelper::getValue($post,'BasicMessage');
        ArrayHelper::remove($post,'BasicMessage');
        $b_id    = intval($base_message['id']);
        // 处理基本信息
        $base_message_model = new BaseMessage();
        $save_base_message  = $base_message_model->updateBaseMessage($b_id,$base_message);
        // 处理info信息
        $deal_data =  $this->dealPostParam($post);
        $deal      = $base_message_model->editAllApiMessage($deal_data,$b_id);
        if ($save_base_message || $deal) {//基本信息的修改
            $url   = Url::toRoute(['index/api-detail','id'=>$b_id]);
            return $this->redirect($url);
        } else {
            $url = Url::toRoute(['index/api-edit','id'=>$b_id]);
            return $this->redirect($url);
            // echo json_encode(['errorcode'=>1,'msg'=>'添加失败']);exit;
        }
    }
    public function dealPostParam($data)
    {
        $return = [];
        if (!empty($data)) {
            foreach ($data as $ko => $vo) {
                $arr   = explode('_',$ko);
                $index = strpos($ko,'_');
                $table = substr($ko,0,$index); 
                $field = substr($ko,$index+1); 
                $return[$table][$field] = $vo;
            }
        }
        return $return;
    }
    /**
     * Updates an existing baseMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing baseMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the baseMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return baseMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = baseMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
