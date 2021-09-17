<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentosActivacion */

$this->title = 'Actualizar documento de activación: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Documentos de activación', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="documentos-activacion-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
