<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\baseMessage */
?>
<div class="body-content">
    <div class="row">
        <div class="col-lg-11">
            <h2>Return Param</h2>
            <div id="post-form" class="form-part">
                <?php $form = ActiveForm::begin(['action' => ['index/ajax-return'],'method'=>'post']); ?>
                    
                    <?= Html::hiddenInput('cid', $cid); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'is_required')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'detail')->textArea(['rows' => 6]) ?>
                    
                    <div class="form-group" data-cid="<?=$cid?>" >
                        <?= Html::submitButton(Yii::t('app', '下一步'), ['class' =>'btn btn-success']) ?>
                        <?= Html::button(Yii::t('app', '跳过'), ['class' => 'btn btn-warning go-next']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <p><a class="btn btn-default clicktest" href="javascript:void(0);">You can test here   &raquo;</a></p>
        </div>
    </div>
</div>