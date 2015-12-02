<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\baseMessage */

$this->title = 'Update Base Message: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Base Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
