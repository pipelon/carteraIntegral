<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procesos-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/procesos/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/procesos/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> ' . 'Borrar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'cliente_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->cliente->nombre . ' (' . $data->cliente->documento . ')';
                    },
                ],
                [
                    'attribute' => 'deudor_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->deudor->nombre . ' (' . $data->deudor->marca . ')';
                    },
                ],
                [
                    'attribute' => 'colaboradores',
                    'format' => 'raw',
                    'value' => implode(", ", \yii\helpers\ArrayHelper::map(
                                    $model->procesosXColaboradores,
                                    'user_id', function($modelProxCol) {
                                        return $modelProxCol->user->name;
                                    }
                            )
                    ),
                ],
                [
                    'label' => strtoupper('ESTUDIO PREJURIDICO'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'prejur_fecha_recepcion:date',
                [
                    'attribute' => 'prejur_tipo_caso',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->prejurTipoCaso->nombre;
                    },
                ],
            ],
        ]);
        ?>
    </div>
</div>
