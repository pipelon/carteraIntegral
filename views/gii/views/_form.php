<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form box box-primary">
    <div class="box-header with-border">
    <?= "<?php " ?> if (\Yii::$app->user->can('/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/index') || \Yii::$app->user->can('/*')) : <?= " ?>" ?>
        
            <?= "<?= " ?>Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.<?= $generator->generateString('Volver') ?>, ['index'], ['class' => 'btn btn-default']) ?>
        <?= "<?php " ?> endif; <?= " ?>" ?> 
        </div>
    <?= "<?php " ?>$form = ActiveForm::begin(
                    [
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{hint}\n{error}\n",
                            'options' => ['class' => 'form-group col-md-6'],
                            'horizontalCssClasses' => [
                                'label' => '',
                                'offset' => '',
                                'wrapper' => '',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
    ); ?>
    <div class="box-body table-responsive">
        
        <div class="form-row">

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    </div>
    </div>
    <div class="box-footer">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Guardar') ?>, ['class' => 'btn btn-primary']) ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
