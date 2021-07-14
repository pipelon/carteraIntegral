<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */

$this->title = 'Actualizar Procesos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="procesos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
