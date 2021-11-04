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
            <?= Html::a('<i class="flaticon-add" ></i> ' . 'Nuevo proceso', ['create'], ['class' => 'btn btn-primary']) ?>
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
                'id',
                [
                    'attribute' => 'cliente_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a($data->cliente->nombre, ['clientes/viewsummary', 'id' => $data->cliente_id], ['class' => 'popupModal']);
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
                        return Html::a($data->deudor->nombre, ['deudores/viewsummary', 'id' => $data->deudor_id], ['class' => 'popupModal']);
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Deudores::find()
                                    ->all()
                            , 'id', function($model) {
                                return '(' . $model['marca'] . ') - ' . $model['nombre'];
                            })
                ],
                [
                    'attribute' => 'prejur_valor_activacion',
                    'label' => 'PRE: V. activación',
                    'value' => function ($data) {
                        return "$" . number_format($data->prejur_valor_activacion, 0, ",", ".");
                    },
                ],
                [
                    'attribute' => 'prejur_saldo_actual',
                    'label' => 'PRE: Saldo actual',
                    'value' => function ($data) {
                        return "$" . number_format($data->prejur_saldo_actual, 0, ",", ".");
                    },
                ],
                [
                    'attribute' => 'jur_valor_activacion',
                    'label' => 'JUR: V. activación',
                    'value' => function ($data) {
                        return "$" . number_format($data->jur_valor_activacion, 0, ",", ".");
                    },
                ],
                [
                    'attribute' => 'jur_saldo_actual',
                    'label' => 'JUR: Saldo actual',
                    'value' => function ($data) {
                        return "$" . number_format($data->jur_saldo_actual, 0, ",", ".");
                    },
                ],
                [
                    'attribute' => 'estado_proceso_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->estadoProceso->nombre;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\EstadosProceso::find()
                                    ->where(['activo' => 1])
                                    ->orderBy(['nombre' => SORT_ASC])
                                    ->all()
                            , 'id', 'nombre')
                ],
                [
                    'header' => 'resumen',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $html = Html::a(
                                        '<i class="flaticon-search-magnifier-interface-symbol"></i> Prejurídico',
                                        [
                                            'procesos/view-summary-prejuridico',
                                            'id' => $data->id
                                        ],
                                        ['class' => 'popupModal btn btn-info']);

                        return $html;
                    }
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

                            //Colaboradores
                            $colaboradores = array_column($model->procesosXColaboradores, 'user_id');
                            //Lider
                            $lider = $model->jefe_id;
                            //ID usuario logueado
                            $userId = (int) \Yii::$app->user->id;
                            //Puede editar
                            if (in_array($userId, $colaboradores) ||
                                    $userId == $lider ||
                                    Yii::$app->user->identity->isSuperAdmin()) {
                                return Html::a('<span class="flaticon-edit-1 text-green" ></span>', $url, [
                                            'title' => 'Editar',
                                ]);
                            }
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


<?php
yii\bootstrap\Modal::begin([
    'id' => 'modal',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
]);
yii\bootstrap\Modal::end();

$this->registerJs("$(function() {
   $('.popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
?>
