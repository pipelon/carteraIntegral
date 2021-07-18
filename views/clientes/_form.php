<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form box box-primary">

    <!-- MUESTRA EL BOTON VOLVER SOLO CUANDO ESTA EN EL CRUD NORMAL -->
    <div class="box-header with-border">
        <?php if ((\Yii::$app->user->can('/clientes/index') || \Yii::$app->user->can('/*')) && (!isset($isAjax) || $isAjax == false)) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>

    <!-- MENSAJE DE ALERTA DE CREACION DE REGISTRO SOLO CUANDO ES UNA PETICION AJAX -->
    <?php if (isset($isAjax) && $isAjax == true): ?>
        <div class="alert alert-success alert-dismissable alert-reponse-ajax" 
             style="display: none">            
            <h4><i class="icon fa fa-check"></i>Creado!</h4>
            Ya puedes encontrar tu nuevo cliente en el listado de Clientes.
        </div>
    <?php endif; ?>

    <?php
    $form = ActiveForm::begin(
                    [
                        'id' => isset($isAjax) && $isAjax == true ? "form_clientes" : "form", //SI ES AJAX EL FORM DEBE TENER UN ID
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

                <?= $form->field($model, 'documento')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
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

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- FUNCION AJAX PARA CREAR UN REGISTRO SOLO SI LA PETICION FUE POR AJAX -->
<?php if (isset($isAjax) && $isAjax == true): ?>
    <script type="text/javascript">
        
        $('#form_clientes').on('beforeSubmit', function (e) {
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (data.status == "ok" && data.msg == "guardado") {
                        $('.alert-reponse-ajax').show("slow");
                        $('#form_clientes').hide();
                    }
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
        }).on('submit', function (e) {
            e.preventDefault();
        });

    </script>
<?php endif; ?>