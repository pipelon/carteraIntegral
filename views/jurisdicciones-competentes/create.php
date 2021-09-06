<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JurisdiccionesCompetentes */

$this->title = 'Crear jurisdicción competentes';
$this->params['breadcrumbs'][] = ['label' => 'Jurisdicciones competentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurisdicciones-competentes-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
