<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JurisdiccionesCompetentes */

$this->title = 'Actualizar jurisdicción competente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jurisdicciones competentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="jurisdicciones-competentes-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
