<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JurisdiccionesCompetentes */

$this->title = 'Crear Jurisdicciones Competentes';
$this->params['breadcrumbs'][] = ['label' => 'Jurisdicciones Competentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurisdicciones-competentes-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
