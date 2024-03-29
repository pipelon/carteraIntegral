<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JurisdiccionesCompetentes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jurisdicciones Competentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurisdicciones-competentes-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/jurisdicciones-competentes/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/jurisdicciones-competentes/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 15px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/jurisdicciones-competentes/delete') || \Yii::$app->user->can('/*')) :  ?>        
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
                'ciudad_id',
                'entidad',
                'codigo_entidad',
                'especialidad',
                'codigo_especialidad',
                'despacho',
                'nombre',
                'email',
                'created',
                'created_by',
                'modified',
                'modified_by',
                'delete',
                'deleted',
                'deleted_by',
            ],
        ]) ?>
    </div>
</div>
