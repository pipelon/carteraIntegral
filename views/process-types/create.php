<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessTypes */

$this->title = 'Crear tipo de proceso';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-types-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
