<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertas */

$this->title = $model->tipo_alerta_id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Alertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-alertas-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/tipos-alertas/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/tipos-alertas/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 15px"></i> ' . 'Actualizar', ['update', 'id' => $model->tipo_alerta_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/tipos-alertas/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 15px"></i> ' . 'Borrar', ['delete', 'id' => $model->tipo_alerta_id], [
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
                'tipo_alerta_id',
                'dias_para_alerta',
                'asunto',
                'descripcion:ntext',
                [
                    'attribute' => 'activa',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->activa);
                    },
                ],
                [
                    'attribute' => 'tipo_proceso_id_1',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->tipoProceso->nombre ?? null;
                    },
                ],
                [
                    'attribute' => 'depende_de_etapa_1',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->etapasProcesal->nombre ?? null;
                    },
                ],
                [
                    'attribute' => 'tipo_proceso_id_2',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->tipoProceso2->nombre ?? null;
                    },
                ],
                [
                    'attribute' => 'depende_de_etapa_2',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->etapasProcesal2->nombre ?? null;
                    },
                ],
                'created:date',
                'created_by',
                'modified:date',
                'modified_by',
            ],
        ])
        ?>
    </div>
</div>
