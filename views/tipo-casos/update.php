<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCasos */

$this->title = 'Actualizar tipo de caso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de casos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-casos-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
