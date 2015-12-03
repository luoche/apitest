<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model   = new Category();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionAjaxCreate()
    {
        $request = Yii::$app->request;
        $model   = new Category();
        $data    = $request->post();
        if ($model->load($data)) {
            $model->name   = trim($model->name);
            $model->status = 1;
            $model->sort   = 1;
            $flag = $model->save();
            if (!$flag) {
                echo json_encode(['errorcode'=>1,'msg'=>'添加失败']);exit;
            } else {
                echo json_encode(['errorcode'=>0,'msg'=>'添加成功']);exit;
            }
        }
    }
    public function actionTest()
    {
        $model = Category::getAllCategory();

         if ($model->load($data)) {
            $model->status = 1;
            $model->sort   = 1;
            $flag = $model->save();
            if (!$flag) {
                echo  json_encode(['errorcode'=>1,'msg'=>'添加失败']);exit;
            } else {
                echo json_encode(['errorcode'=>0,'msg'=>'添加成功']);exit;
            }
        }
    }
    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        exit;
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        exit;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
