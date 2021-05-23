<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prueba */

$this->title = 'Actualizar Prueba: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pruebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prueba-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
