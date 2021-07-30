<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesales */

$this->title = 'Crear etapa procesal';
$this->params['breadcrumbs'][] = ['label' => 'Etapas procesales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-procesales-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
