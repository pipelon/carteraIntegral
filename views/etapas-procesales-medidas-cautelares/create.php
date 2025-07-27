<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesalesMedidasCautelares */

$this->title = 'Crear Etapas Procesales Medidas Cautelares';
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales Medidas Cautelares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-procesales-medidas-cautelares-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
