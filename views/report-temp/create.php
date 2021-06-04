<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReportTemp */

$this->title = 'Crear Report Temp';
$this->params['breadcrumbs'][] = ['label' => 'Report Temps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-temp-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
