<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportTemp */

$this->title = 'Actualizar Report Temp: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Report Temps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="report-temp-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
