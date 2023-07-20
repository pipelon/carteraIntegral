<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Liquidaciones */

$this->title = 'Actualizar Liquidación: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Liquidaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="liquidaciones-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
