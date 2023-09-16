<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LiquidacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liquidaciones';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/liquidaciones/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/liquidaciones/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/liquidaciones/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/liquidaciones/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/liquidaciones/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" ></i> ' . 'Crear Liquidaciones', ['create'], ['class' => 'btn btn-primary']) ?>
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
                        return $data->cliente->nombre;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Clientes::find()
                                    ->orderBy('nombre ASC')
                                    ->all()
                            , 'id', 'nombre')
                ],
                [
                    'attribute' => 'deudor_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->deudor->nombre;
                    },
                    'filter' => yii\helpers\ArrayHelper::map(
                            \app\models\Deudores::find()
                                    ->orderBy('nombre ASC')
                                    ->all()
                            , 'id', 'nombre')
                ],
                [
                    'attribute' => 'ciudad',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->ciudad == 1 ? "Medellín" : "Bogotá";
                    },
                    'filter' => ["1" => "Medellín", "2" => "Bogotá"]
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a("<span class='flaticon-search-magnifier-interface-symbol'></span> Vista previa",
                                        ["liquidaciones/vista-previa", "id" => $data->id],
                                        ["target" => "_blank"]);
                    },
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a("<span class='flaticon-search-magnifier-interface-symbol'></span> Generar Carta",
                                        ["liquidaciones/generar", "id" => $data->id, "tipo" => "carta"],
                                        ["target" => "_blank"]);
                    },
                ],
                [
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a("<span class='flaticon-search-magnifier-interface-symbol'></span> Generar Liquidación",
                                        ["liquidaciones/generar", "id" => $data->id, "tipo" => "liquidacion"],
                                        ["target" => "_blank"]);
                    },
                ],
                // 'created',
                // 'created_by',
                // 'modified',
                // 'modified_by',
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
