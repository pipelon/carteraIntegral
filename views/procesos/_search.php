<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procesos-search" style="margin: 50px 0;">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <?php
    $estadosProcesoList = yii\helpers\ArrayHelper::map(
                    \app\models\EstadosProceso::find()
                            ->where(['activo' => 1])
                            ->orderBy(['nombre' => SORT_ASC])
                            ->all()
                    , 'id', 'nombre');
    ?>
    <?=
    $form->field($model, 'estado_proceso_id')->checkboxList($estadosProcesoList, ['prompt' => '- Seleccion un estado -'])
    ?>

    <?=
    $form->field($model, 'buscador', [
        'template' => '<div class="input-group">
            <span class="input-group-addon flaticon-search-magnifier-interface-symbol"></span>{input}<span class="input-group-btn">
                      <button type="submit" class="btn btn-primary btn-flat">Buscar!</button>
                    </span></div>{error}{hint}'
    ])->textInput(['placeholder' => "# de radicado, documento y nombre de clientes,valor de activación y/o deudores, estados"]);
    ?>

    <?php ActiveForm::end(); ?>

</div>
