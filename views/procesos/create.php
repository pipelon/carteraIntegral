<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */

$this->title = 'Crear Proceso';
$this->params['breadcrumbs'][] = ['label' => 'Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procesos-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelPagos' => $modelPagos,
        'modelAcuerdoPagos' => $modelAcuerdoPagos,
        'modelTareas' => $modelTareas,
    ])
    ?>

</div>
