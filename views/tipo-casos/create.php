<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCasos */

$this->title = 'Crear Tipo de caso';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de casos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-casos-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
