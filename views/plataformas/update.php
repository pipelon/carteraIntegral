<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Plataformas */

$this->title = 'Actualizar plataforma: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Plataformas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="plataformas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
