<?php

/* @var $this yii\web\View */

$this->title = 'add api here';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-11">
                <h2>Base Message Fields</h2>
                <div id="base_message-form" class="form-part">
                    <?php $form = ActiveForm::begin(['action' => ['index/ajax-base-message'],'method'=>'post']); ?>

                        <?= $form->field($base_message, 'cate')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($base_message, 'url')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($base_message, 'detail')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($base_message, 'tag')->textInput(['maxlength' => true])->hint('多个用,分开') ?>

                        <?= $form->field($base_message, 'author')->textInput(['maxlength' => true]) ?>
                        
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', '下一步'), ['class' =>'btn btn-success']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>

                <p><a class="btn btn-default clicktest" href="javascript:void(0);">You can test here   &raquo;</a></p>
            </div>
        </div>
</div>