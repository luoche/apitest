<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\baseMessage */

$this->title = 'Create Base Message';
$this->params['breadcrumbs'][] = ['label' => 'Base Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
