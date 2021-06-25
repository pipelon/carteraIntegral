<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/personas/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/personas/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/personas/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/personas/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="personas-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/personas/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" style="font-size: 20px"></i> ' . 'Crear persona', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'id',
                'nit',
                'digverifica',
                'tipodeudor',
                'firstname',
                'lastname',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="flaticon-search-magnifier-interface-symbol" style="font-size: 20px"></span>', $url, [
                                        'title' => 'Ver',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="flaticon-edit-1" style="font-size: 20px"></span>', $url, [
                                        'title' => 'Editar',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="flaticon-circle" style="font-size: 20px"></span>', $url, [
                                        'data-confirm' => '¿Está seguro que desea eliminar este ítem?',
                                        'data-method' => 'post',
                                        'title' => 'Borrar',
                            ]);
                        }
                    ]
                ],
            ],
        ]);
        ?>
    </div>
</div>
