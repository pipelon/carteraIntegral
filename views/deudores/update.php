<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deudores */

$this->title = 'Actualizar deudor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Deudores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="deudores-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
