<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */

$this->title = 'Actualizar Proceso';
$this->params['breadcrumbs'][] = ['label' => 'Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="procesos-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelPagos' => $modelPagos,
    ]) ?>

</div>
