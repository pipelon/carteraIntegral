<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */

$js = '
    /* FUNCION PARA CALCULAR EL DIGITO DE VERIFICACION */
    jQuery("#documento").blur(function () {
        let documento = jQuery(this).val();
        $.ajax("' . yii\helpers\Url::to(['clientes/digitoverificacion']) . '?id=" + documento, {
            dataType: "json",
            type: "post",
        }).done(function(data) {        
            jQuery("#documento").val(documento + \'-\' + data);
        });
    });
';
$this->registerJs($js);
?>

<div class="clientes-form box box-primary">    
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/clientes/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>    
    <?php
    $form = ActiveForm::begin(
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
    );
    ?>
    <div class="box-body table-responsive">

        <div class="form-row">

            <div class="row-field">
                <?=
                $form->field($model, 'tipo_documento')->dropDownList(Yii::$app->utils->filtroTipoDocumento())
                ?>

                <?= $form->field($model, 'documento')->textInput(['maxlength' => true, 'id' => 'documento']) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
            </div>

            <!-- REPRESENTANTE LEGAL -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Representante legal</h3>
                    </div>
                    <div class="box-body">
                        <div class="row-field">
                            <?= $form->field($model, 'nombre_representante_legal')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'telefono_representante_legal')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="row-field">
                            <?= $form->field($model, 'email_representante_legal')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <!-- CONTACTO PRINCIPAL -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Persona de contacto principal</h3>
                    </div>
                    <div class="box-body">
                        <?= $form->field($model, 'nombre_persona_contacto_1')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'telefono_persona_contacto_1')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email_persona_contacto_1')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'cargo_persona_contacto_1')->textInput(['maxlength' => true]) ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <!-- CONTACTO #2 -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Persona de contacto #2</h3>
                    </div>
                    <div class="box-body">
                        <?= $form->field($model, 'nombre_persona_contacto_2')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'telefono_persona_contacto_2')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email_persona_contacto_2')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'cargo_persona_contacto_2')->textInput(['maxlength' => true]) ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <!-- CONTACTO #3 -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Persona de contacto #3</h3>
                    </div>
                    <div class="box-body">
                        <?= $form->field($model, 'nombre_persona_contacto_3')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'telefono_persona_contacto_3')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email_persona_contacto_3')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'cargo_persona_contacto_3')->textInput(['maxlength' => true]) ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <!-- CARPETA GOOGLE DRIVE -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Documentos</h3>
                    </div>
                    <div class="box-body">
                        <?=
                        $form->field($model, 'carpeta', [
                            'template' => "{label}\n{input}\n{hint}\n{error}\n",
                            'options' => ['class' => 'form-group col-md-12'],
                        ])->textInput(['maxlength' => true])
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <!-- USUARIO -->
            <div class="row-field">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuario que maneja este cliente</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        $usuariosClientesList = yii\helpers\ArrayHelper::map(
                                        \Yii::$app->user->identity->getUserNamesByRole("Cliente")
                                        , 'id', 'name')
                        ?>

                        <?=
                        $form->field($model, 'usuario_id')->dropDownList($usuariosClientesList, ['prompt' => '- Seleccione un usuario -'])
                        ?>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>