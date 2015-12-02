<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\baseMessage */
?>

<div class="body-content">

    <div class="row">
        <div class="col-lg-11">
            <h2>Error Define</h2>
            <div id="post-form" class="form-part">
                <?php $form = ActiveForm::begin(['action' => ['index/ajax-error'],'method'=>'post']); ?>
					
					<?= Html::hiddenInput('cid', $cid); ?>

                    <?= $form->field($model, 'errorcode')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'msg')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'solve_answer')->textInput(['maxlength' => true]) ?>
                    
                    <div class="form-group" data-cid="<?=$cid?>" >
                        <?= Html::submitButton(Yii::t('app', '完成'), ['class' =>'btn btn-success']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>

            <p><a class="btn btn-default clicktest" href="javascript:void(0);">You can test here   &raquo;</a></p>
        </div>
    </div>
</div>