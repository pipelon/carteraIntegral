<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesales */

$this->title = 'Actualizar etapa procesal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas procesales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="etapas-procesales-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
