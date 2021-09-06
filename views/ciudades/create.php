<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ciudades */

$this->title = 'Crear ciudad';
$this->params['breadcrumbs'][] = ['label' => 'Ciudades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudades-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
