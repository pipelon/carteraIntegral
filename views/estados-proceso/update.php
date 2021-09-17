<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosProceso */

$this->title = 'Actualizar estado de proceso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estados de proceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="estados-proceso-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
