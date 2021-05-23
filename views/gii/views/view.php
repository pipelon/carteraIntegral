<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view box box-primary">
    <div class="box-header">
        <?= "<?php " ?> if (\Yii::$app->user->can('/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/index') || \Yii::$app->user->can('/*')) : <?= " ?>" ?>
        
            <?= "<?= " ?>Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.<?= $generator->generateString('Volver') ?>, ['index'], ['class' => 'btn btn-default']) ?>
        <?= "<?php " ?> endif; <?= " ?>" ?> 
        <?= "<?php " ?> if (\Yii::$app->user->can('/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/update') || \Yii::$app->user->can('/*')) : <?= " ?>" ?>
        
            <?= "<?= " ?>Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> '.<?= $generator->generateString('Actualizar') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?= "<?php " ?> endif; <?= " ?>" ?> 
        <?= "<?php " ?> if (\Yii::$app->user->can('/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/delete') || \Yii::$app->user->can('/*')) : <?= " ?>" ?>
        
            <?= "<?= " ?>Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> '.<?= $generator->generateString('Borrar') ?>, ['delete', <?= $urlParams ?>], [        
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => <?= $generator->generateString('¿Está seguro que desea eliminar este ítem?') ?>,
                    'method' => 'post',
                ],
            ]) ?>
        <?= "<?php " ?> endif; <?= " ?>" ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = stripos($column->name, 'created_at') !== false || stripos($column->name, 'updated_at') !== false ? 'datetime' : $generator->generateColumnFormat($column);
        echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
            ],
        ]) ?>
    </div>
</div>
