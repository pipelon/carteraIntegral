<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProcesos */

$this->title = 'Crear tipo de proceso';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-procesos-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
