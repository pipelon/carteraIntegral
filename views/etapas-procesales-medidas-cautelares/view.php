<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesalesMedidasCautelares */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales Medidas Cautelares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-procesales-medidas-cautelares-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/etapas-procesales-medidas-cautelares/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/etapas-procesales-medidas-cautelares/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 15px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/etapas-procesales-medidas-cautelares/delete') || \Yii::$app->user->can('/*')) :  ?>        
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
                'tipo_proceso_id',
                'nombre',
                'activo',
                'delete',
                'created',
                'created_by',
                'modified',
                'modified_by',
                'deleted',
                'deleted_by',
            ],
        ]) ?>
    </div>
</div>
