<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/procesos/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/procesos/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/procesos/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/procesos/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="procesos-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/procesos/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" ></i> ' . 'Nuevo Proceso', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
            'columns' => [
                [
                    'attribute' => 'cliente_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->cliente->nombre;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Clientes::find()
                                    ->all()
                            , 'id', function($model) {
                                return '(' . $model['documento'] . ') - ' . $model['nombre'];
                            })
                ],
                [
                    'attribute' => 'deudor_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->deudor->nombre;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Deudores::find()
                                    ->all()
                            , 'id', function($model) {
                                return '(' . $model['marca'] . ') - ' . $model['nombre'];
                            })
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="flaticon-search-magnifier-interface-symbol" ></span>', $url, [
                                        'title' => 'Ver',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="flaticon-edit-1 text-green" ></span>', $url, [
                                        'title' => 'Editar',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="flaticon-circle text-red" ></span>', $url, [
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