<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProcesos */

$this->title = 'Actualizar tipo de proceso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-procesos-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
