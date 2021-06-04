<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessTypes */

$this->title = 'Actualizar tipo de proceso: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Process Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="process-types-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
