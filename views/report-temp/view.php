<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReportTemp */

$this->title = "Radicado : " . $model->col11 . " / " . $model->col17 . " / " . $model->col2;

$this->params['breadcrumbs'][] = ['label' => 'Informe de gestión', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-temp-view box box-primary">
    <div class="box-header">
        <?php  if (\Yii::$app->user->can('/report-temp/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
        <?php  //if (\Yii::$app->user->can('/report-temp/update') || \Yii::$app->user->can('/*')) :  ?>        
            <?php //Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  //endif;  ?> 
        <?php  //if (\Yii::$app->user->can('/report-temp/delete') || \Yii::$app->user->can('/*')) :  ?>        
            <?php /*Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> '.'Borrar', ['delete', 'id' => $model->id], [        
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ]) */ ?>
        <?php  //endif;  ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'col1',
                'col2',
                'col3',
                'col4',
                'col5',
                'col6',
                'col7',
                'col8',
                'col9',
                'col10',
                'col11',
                'col12',
                'col13',
                'col14',
                'col15',
                'col16',
                'col17',
            ],
        ]) ?>
    </div>
</div>
