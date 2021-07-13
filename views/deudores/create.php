<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deudores */

$this->title = 'Crear Deudor';
$this->params['breadcrumbs'][] = ['label' => 'Deudores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deudores-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
