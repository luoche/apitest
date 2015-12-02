<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ReturnParam;
use app\models\ReturnCode;
use app\models\ErrorMessage;
/* @var $this yii\web\View */
/* @var $model app\models\baseMessage */

$this->title = 'Add Post Param';
// $this->params['breadcrumbs'][] = ['label' => 'Base Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-11">
                <h2>Post Param</h2>
                <div id="post-form" class="form-part">
                    <?php $form = ActiveForm::begin(['action' => ['index/ajax-post'],'method'=>'post']); ?>
						
						<?= Html::hiddenInput('cid', $cid); ?>

                        <!-- <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> -->
						<?= Html::activeInput('text', $model, 'name', ['class' => $model->name]) ?>
                        <!-- <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?> -->
						<?= Html::activeInput('text', $model, 'type', ['class' => $model->type]) ?>

                        <!-- <?= $form->field($model, 'is_required')->textInput(['maxlength' => true]) ?> -->
						<?= Html::activeInput('text', $model, 'is_required', ['class' => $model->is_required]) ?>
                        <!-- <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?> -->
						<?= Html::activeInput('text', $model, 'value', ['class' => $model->value]) ?>		
                        <!-- <?= $form->field($model, 'detail')->textArea(['rows' => 6]) ?> -->
						<?= Html::activeInput('text', $model, 'detail', ['class' => $model->detail]) ?>
                    <?php ActiveForm::end(); ?>
                </div>

                <p><a class="btn btn-default clicktest" href="javascript:void(0);">You can test here   &raquo;</a></p>
            </div>
        </div>
		<?= $this->render('return-param', ['model' => new ReturnParam(),'cid'=>$cid]) ?>
		<?= $this->render('return-code', ['model' => new ReturnCode(),'cid'=>$cid]) ?>
		<?= $this->render('error-msg', ['model' => new ErrorMessage(),'cid'=>$cid]) ?>
</div>