<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bienes */

$this->title = 'Actualizar bien: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="bienes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
