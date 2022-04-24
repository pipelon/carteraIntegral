<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposAlertasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos Alertas';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/tipos-alertas/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/tipos-alertas/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/tipos-alertas/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/tipos-alertas/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="tipos-alertas-index box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/tipos-alertas/create') || \Yii::$app->user->can('/*')) :  ?> 
        <?= Html::a('<i class="flaticon-add" ></i> '.'Crear Tipos Alertas', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
 'tableOptions'=>['class'=>'table table-striped table-bordered table-condensed'],
           'columns' => [
                //'tipo_alerta_id',
                'dias_para_alerta',
                'asunto',
                'descripcion:ntext',
                'activa',
                'depende_de_etapa_1',
                'depende_de_etapa_2',
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
        ]); ?>
    </div>
</div>
