<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Plataformas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Plataformas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plataformas-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/plataformas/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/plataformas/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  endif;  ?> 
        <?php  if (\Yii::$app->user->can('/plataformas/delete') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> '.'Borrar', ['delete', 'id' => $model->id], [        
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
                'modified_by',
            ],
        ]) ?>
    </div>
</div>
