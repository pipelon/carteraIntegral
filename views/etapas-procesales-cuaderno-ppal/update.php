<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesalesCuadernoPpal */

$this->title = 'Actualizar Etapas Procesales Cuaderno Ppal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales Cuaderno Ppals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="etapas-procesales-cuaderno-ppal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
