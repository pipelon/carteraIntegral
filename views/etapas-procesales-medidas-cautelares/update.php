<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesalesMedidasCautelares */

$this->title = 'Actualizar Etapas Procesales Medidas Cautelares: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales Medidas Cautelares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="etapas-procesales-medidas-cautelares-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
