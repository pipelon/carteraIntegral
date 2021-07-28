<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentosActivacion */

$this->title = 'Crear documento activación';
$this->params['breadcrumbs'][] = ['label' => 'Documentos de activación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-activacion-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
