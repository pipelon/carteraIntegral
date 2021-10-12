<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-procesales-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/etapas-procesales/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/etapas-procesales/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 15px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/etapas-procesales/delete') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-circle" style="font-size: 15px"></i> '.'Borrar', ['delete', 'id' => $model->id], [        
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'tipo_proceso_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->tipoProceso->nombre;
                    },
                ],
                'nombre',
                [
                    'attribute' => 'activo',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->getConditional($data->activo);
                    },
                ],                
                'created:date',
                'created_by',
                'modified:date',
                'modified_by'
            ],
        ]) ?>
    </div>
</div>
