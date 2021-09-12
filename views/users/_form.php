<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
    jQuery("document").ready(function () {
        jQuery("#p1,#p2").val("");
    });
JS;
$this->registerJs($js);
?>

<div class="users-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/users/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
    <?php
    $form = ActiveForm::begin(
                    [
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{hint}\n{error}\n",
                            'options' => [
                                'class' => 'form-group col-md-6',
                                'enctype' => 'multipart/form-data'
                            ],
                            'horizontalCssClasses' => [
                                'label' => '',
                                'offset' => '',
                                'wrapper' => '',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
    );
    ?>
    <div class="box-body table-responsive">

        <div class="form-row">

            <div class="row-field text-center">

                <?php
                $profileImage = Yii::$app->user->identity->profileImage && file_exists("perfiles/" . Yii::$app->user->identity->profileImage) ?
                        Yii::$app->user->identity->profileImage : "default-user.png";
                ?>
                <?=
                Html::img("@web/perfiles/{$profileImage}",
                        [
                            'style' => 'width: 100px; heigth: 100px; margin: 30px 0;',
                            'alt' => 'User Image',
                            'class' => 'img-circle'
                        ]
                )
                ?>       

            </div>

            <div class="row-field">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'autocomplete' => "off", 'id' => 'p1']) ?>

                <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true, 'autocomplete' => "off", 'id' => 'p2']) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'active')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
            </div>
            <div class="row-field">                
                <?=
                $form->field($model, 'profile_image')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'allowedFileExtensions' => ['jpg'],
                        'removeClass' => 'btn btn-danger',
                        'browseIcon' => '<i class="flaticon-folder"></i> ',
                        'showPreview' => false,
                        'showUpload' => false,
                        'removeIcon' => '<i class="flaticon-circle"></i> '
                    ]
                ]);
                ?>
            </div>            
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
