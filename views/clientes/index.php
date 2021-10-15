<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/clientes/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/clientes/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/clientes/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/clientes/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="clientes-index box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/clientes/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" ></i> ' . 'Crear cliente', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'tableOptions'=>['class'=>'table table-striped table-bordered table-condensed'],
            'columns' => [
                [
                    'attribute' => 'tipo_documento',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->filtroTipoDocumento($data->tipo_documento);
                    },
                    'filter' => Yii::$app->utils->filtroTipoDocumento()
                ],
                'documento',
                'nombre',
                'direccion',
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
