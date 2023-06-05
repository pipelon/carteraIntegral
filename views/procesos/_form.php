<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */
/* @var $form yii\widgets\ActiveForm */


// ARCHIVO CON TODOS LOS JS NECESARIOS PARA EL PROCESO
$this->registerJsFile(Yii::getAlias('@web') . '/js/proceso.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<!-- INICIO DEL FORMULARIO -->
<?php
$form = ActiveForm::begin(
                [
                    'id' => 'dynamic-form',
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

<!-- CAMPO OCULTO PARA SABER SI ESTOY CREANDO O EDITANDO Y ASI EVITAR EL AUTOSAVE EN EL CREATE -->
<?= Html::hiddenInput('isUpdateForm', !$model->isNewRecord ? "si" : "no", ['id' => 'isUpdateForm']); ?>

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
        <?= Html::submitButton('<i class="flaticon-paper-plane" style="font-size: 15px"></i> ' . 'Guardar', ['class' => 'btn btn-primary']) ?>
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default pull-right']) ?>
        <?php endif; ?> 
    </div>
</div>

<!-- ESTADO DEL PROCESO -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">ESTADO DEL PROCESO</h3>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?php
            $estadosProcesoList = yii\helpers\ArrayHelper::map(
                            \app\models\EstadosProceso::find()
                                    ->where(['activo' => 1])
                                    ->orderBy(['nombre' => SORT_ASC])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'estado_proceso_id', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['estado_proceso_id']) . "{label}\n{input}\n{hint}\n{error}\n"
            ])->dropDownList($estadosProcesoList, ['prompt' => '- Seleccion un estado -'])
            ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- ROW PARA CLIENTES Y DEUDORES -->
<div class="row">

    <!-- MODULO DE CLIENTE -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">CLIENTE</h3>
            </div>
            <div class="box-body">
                <?php
                $initSelection = new JsExpression(
                        'function (element, callback) {
                        let id = $(element).val();                                
                        if (id !== "") {                                        
                            $.ajax("' . Url::to(['clientes/getclientes']) . '?id=" + id, {
                                dataType: "json",
                                type: "post",
                            }).done(function(data) {
                                callback(data.results); 
                            });
                        }
                    }'
                );
                ?>
                <?=
                        $form->field($model, 'cliente_id', [
                            'options' => ['class' => 'form-group col-md-12'],
                            "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['clientes']) . "{label}\n{input}\n{hint}\n{error}",
                        ])
                        ->widget(Select2::classname(),
                                [
                                    'language' => 'es',
                                    'options' => ['placeholder' => '- Seleccione un cliente -'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 3,
                                        'ajax' => [
                                            'url' => \yii\helpers\Url::to(['clientes/getclientes']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                        ],
                                        'initSelection' => !$model->isNewRecord ? $initSelection : null
                                    ]
                                ]
                );
                ?>
            </div>
        </div>
    </div>

    <!-- MODULO DE DEUDOR -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">DEUDOR</h3>
            </div>
            <div class="box-body">
                <?php
                $initSelection = new JsExpression(
                        'function (element, callback) {
                        let id = $(element).val();                                
                        if (id !== "") {                                        
                            $.ajax("' . Url::to(['deudores/getdeudores']) . '?id=" + id, {
                                dataType: "json",
                                type: "post",
                            }).done(function(data) {
                                callback(data.results); 
                            });
                        }
                    }'
                );
                ?>
                <?=
                        $form->field($model, 'deudor_id', [
                            'options' => ['class' => 'form-group col-md-12'],
                            "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['deudores']) . "{label}\n{input}\n{hint}\n{error}",
                        ])
                        ->widget(Select2::classname(),
                                [
                                    'language' => 'es',
                                    'options' => ['placeholder' => '- Seleccione un deudor -'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 3,
                                        'ajax' => [
                                            'url' => \yii\helpers\Url::to(['deudores/getdeudores']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                        ],
                                        'initSelection' => !$model->isNewRecord ? $initSelection : null
                                    ]
                                ]
                );
                ?>       
                <?php
                $plataformas = yii\helpers\ArrayHelper::map(
                                \app\models\Plataformas::find()
                                        ->where(['activo' => 1])
                                        ->all()
                                , 'id', 'nombre');
                ?>
                <?=
                $form->field($model, 'plataforma_id', [
                    "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['plataforma']) . "{label}\n{input}\n{hint}\n{error}",
                    'options' => ['class' => 'form-group col-md-12']
                ])->dropDownList($plataformas, ['prompt' => '- Seleccione una plataforma -'])
                ?>
            </div>
        </div>
    </div>
</div>

<!-- COLABORADORES -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">LÍDERES Y COLABORADORES</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <?php
        $lideresList = yii\helpers\ArrayHelper::map(
                        \Yii::$app->user->identity->getUserNamesByRole("Lider")
                        , 'id', 'name');
        $dataList = yii\helpers\ArrayHelper::map(
                        \Yii::$app->user->identity->getUserNamesByRole("Colaborador")
                        , 'id', 'name');
        ?>

        <?=
        $form->field($model, 'jefe_id', ["template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jefe_id']) . "{label}\n{input}\n{hint}\n{error}",])->dropDownList($lideresList, ['prompt' => '- Seleccione un líder -'])
        ?>

        <?=
        $form->field($model, 'colaboradores', ["template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['colaboradores']) . "{label}\n{input}\n{hint}\n{error}",])->widget(Select2::classname(), [
            'data' => $dataList,
            'options' => ['placeholder' => '- Seleccione los colaboradores -', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    </div>
</div>

<!-- ESTUDIO PREJURIDICO -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">ESTUDIO PRE-JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_fecha_recepcion')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
            <?php
            $tipoCasosList = yii\helpers\ArrayHelper::map(
                            \app\models\TipoCasos::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'prejur_tipo_caso', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_tipo_caso']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList($tipoCasosList, ['prompt' => '- Seleccione un tipo de caso -'])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_valor_activacion', ["template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_valor_activacion']) . "{label}\n{input}\n{hint}\n{error}"
            ])->textInput()
            ?>
            <?=
            $form->field($model, 'prejur_saldo_actual', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_saldo_actual']) . "{label}\n{input}\n{hint}\n{error}"
            ])->textInput()
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_carta_enviada', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_carta_enviada']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(
                    ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                    [
                        'prompt' => '- Seleccione -',
                    ]
            )
            ?>
            <?=
            $form->field($model, 'prejur_fecha_carta')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>            
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_llamada_realizada', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_llamada_realizada']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(
                    ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                    [
                        'prompt' => '- Seleccione -',
                    ]
            )
            ?>
            <?=
            $form->field($model, 'prejur_fecha_llamada')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>            
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_visita_domiciliaria', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_visita_domiciliaria']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(
                    ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                    [
                        'prompt' => '- Seleccione -',
                    ]
            )
            ?>
            <?=
            $form->field($model, 'prejur_fecha_visita')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
        </div>
        <!-- ACUERDO DE PAGOS -->

        <?=
        $form->field($model, 'prejur_acuerdo_pago', [
            "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_acuerdo_pago']) . "{label}\n{input}\n{hint}\n{error}",
            "options" => ['class' => 'form-group col-md-12']
        ])->dropDownList(
                ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                [
                    'prompt' => '- Seleccione -',
                    'onchange' => '
                        $("#prejur_fecha_no_acuerdo_pago").val("");
                        if($(this).val() == "NO"){
                            $("#prejur_fecha_no_acuerdo_pago").val( "' . date('Y-m-d') . '");
                        }
                    '
                ]
        )
        ?>

        <?=
                $form->field($model, 'prejur_fecha_no_acuerdo_pago', [
                    "template" => "{input}",
                    "options" => ['class' => ' ']]
                )->hiddenInput(['id' => 'prejur_fecha_no_acuerdo_pago'])
                ->label(false);
        ?>

        <div class="row-field col-md-12 divAcuerdoPago" style="display: none">            

            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_acuerdo_pagos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelAcuerdoPagos[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'fecha_acuerdo_pago',
                    'valor_acuerdo_pago',
                    'descripcion',
                    'fecha_pago_realizado',
                    'valor_pagado',
                ],
            ]);
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="flaticon-coins"></i> Acuerdo de pago
                    <button type="button" class="pull-right add-item btn btn-primary btn-xs"><i class="flaticon-add"></i> Agregar acuerdo y/o pago</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($modelAcuerdoPagos as $index => $mdlPago): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-pagos">Acuerdo: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="flaticon-circle"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$mdlPago->isNewRecord) {
                                    echo Html::activeHiddenInput($mdlPago, "[{$index}]id");
                                }
                                ?>
                                <?=
                                $form->field($mdlPago, "[{$index}]fecha_acuerdo_pago")->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => '- Ingrese una fecha --'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        'todayBtn' => true,
                                    ]
                                ]);
                                ?>
                                <?= $form->field($mdlPago, "[{$index}]valor_acuerdo_pago")->textInput() ?>
                                <?=
                                $form->field($mdlPago, "[{$index}]descripcion", [
                                    'options' => ['class' => 'form-group col-md-12'],
                                ])->textInput(['maxlength' => true])
                                ?>
                                <?=
                                $form->field($mdlPago, "[{$index}]fecha_pago_realizado")->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => '- Ingrese una fecha --'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        'todayBtn' => true,
                                    ]
                                ]);
                                ?>
                                <?= $form->field($mdlPago, "[{$index}]valor_pagado")->textInput() ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
        <!-- FIN ACUERDO DE PAGOS -->
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_rama_judicial', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_consulta_rama_judicial']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_entidad_reguladora', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_consulta_entidad_reguladora']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- ESTUDIO DE BIENES -->
        <div class="row-field">

            <?=
            $form->field($model, 'prejur_resultado_estudio_bienes', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_resultado_estudio_bienes']) . "{label}\n{input}\n{hint}\n{error}",
                "options" => ['class' => 'form-group col-md-12']
            ])->dropDownList(
                    ['SIN DEFINIR' => 'SIN DEFINIR', 'POSITIVO' => 'POSITIVO', 'NEGATIVO' => 'NEGATIVO'],
                    [
                        'prompt' => '- Seleccione -',
                        'onchange' => '
                        $("#prejur_fecha_estudio_bienes").val("");
                        if($(this).val() == "POSITIVO" || $(this).val() == "NEGATIVO"){
                            $("#prejur_fecha_estudio_bienes").val( "' . date('Y-m-d') . '");
                        }
                    '
                    ]
            )
            ?>

            <?=
                    $form->field($model, 'prejur_fecha_estudio_bienes', [
                        "template" => "{input}",
                        "options" => ['class' => ' ']]
                    )->hiddenInput(['id' => 'prejur_fecha_estudio_bienes'])
                    ->label(false);
            ?>
            <?php
            $bienesList = yii\helpers\ArrayHelper::map(
                            \app\models\Bienes::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'prejur_estudio_bienes', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_estudio_bienes']) . "{label}\n{input}\n{hint}\n{error}",
                "options" => ["class" => "form-group col-md-12"],
            ])->checkboxList($bienesList,
                    [
                        'item' => function($index, $label, $name, $checked, $value) use ($model) {
                            $checked = $checked ? "checked" : "";
                            return "<div class='row'>"
                                    . "<div class='col-md-4'>"
                                    . " <div class='checkbox'>"
                                    . "     <label>"
                                    . "         <input type='checkbox' {$checked} name='{$name}' value='{$value}' class='check-bien'> {$label}"
                                    . "     </label>"
                                    . " </div>"
                                    . "</div>"
                                    . "<div class='col-md-8'>"
                                    . Html::input("text", "Procesos[prejur_comentarios_estudio_bienes][{$value}]", $model->prejur_comentarios_estudio_bienes[$value] ?? null,
                                            [
                                                "class" => "form-control comentario-bienes-{$value}",
                                                "placeholder" => "Comentarios",
                                                "style" => "display: none"
                                            ]
                                    )
                                    . "</div>"
                                    . "</div>";
                        }
                    ]
            )
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_informe_castigo_enviado', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_informe_castigo_enviado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(
                    ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                    [
                        'prompt' => '- Seleccione -',
                    ]
            )
            ?>
            <?=
            $form->field($model, 'prejur_carta_castigo_enviada', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_carta_castigo_enviada']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(
                    ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                    [
                        'prompt' => '- Seleccione -',
                    ]
            )
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_concepto_viabilidad', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_concepto_viabilidad']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- GESTIONES PRE JURIDICAS -->
        <div class="row-field gestion-prejuridica">
            <?=
            $form->field($model, 'prejur_gestion_prejuridica', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_gestion_prejuridica']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
            <?php if (!empty($model->prejur_gestiones_prejuridicas)): ?>
                <?php foreach ($model->prejur_gestiones_prejuridicas as $gestion) : ?>
                    <div class="col-md-12">
                        <blockquote>
                            <?= nl2br($gestion->descripcion_gestion); ?>
                            <small><?= $gestion->usuario_gestion; ?> el <cite title="Source Title"><?= $gestion->fecha_gestion; ?></cite></small>
                        </blockquote>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <div class="row-field">
            <?=
            $form->field($model, 'prejur_otros', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['prejur_otros']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
    </div>
</div>

<!-- JURIDICO -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'jur_fecha_recepcion')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
            <?php
            $docActList = yii\helpers\ArrayHelper::map(
                            \app\models\DocumentosActivacion::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'jur_documentos_activacion', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_documentos_activacion']) . "{label}\n{input}\n{hint}\n{error}",
            ])->checkboxList($docActList)
            ?>
        </div>
        <div class="row-field">
            <?php //= $form->field($model, 'jur_valor_activacion', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_valor_activacion']) . "{label}\n{input}\n{hint}\n{error}\n",])->textInput() ?>
            <?= $form->field($model, 'jur_saldo_actual', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_saldo_actual']) . "{label}\n{input}\n{hint}\n{error}\n",])->textInput() ?>
        </div>

        <div class="row-field col-md-12">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_valor_activacion', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelVActivaciones[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'valor'
                ],
            ]);
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="flaticon-coins"></i> Valores de activación
                    <button type="button" class="pull-right add-item btn btn-primary btn-xs"><i class="flaticon-add"></i> Agregar valor activación</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($modelVActivaciones as $index => $modelVActivacion): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-valor">Valor activación: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="flaticon-circle"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$modelVActivacion->isNewRecord) {
                                    echo Html::activeHiddenInput($modelVActivacion, "[{$index}]id");
                                }
                                ?>
                                <?= $form->field($modelVActivacion, "[{$index}]valor")->textInput() ?>                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>

        <!-- CONSOLIDADO DE PAGOS -->
        <div class="row-field col-md-12">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelPagos[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'fecha_pago',
                    'valor',
                ],
            ]);
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="flaticon-coins"></i> Consolidado de pagos
                    <button type="button" class="pull-right add-item btn btn-primary btn-xs"><i class="flaticon-add"></i> Agregar pago</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($modelPagos as $index => $mdlPago): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-pagos">Pago: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="flaticon-circle"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$mdlPago->isNewRecord) {
                                    echo Html::activeHiddenInput($mdlPago, "[{$index}]id");
                                }
                                ?>
                                <?=
                                $form->field($mdlPago, "[{$index}]fecha_pago")->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => '- Ingrese una fecha --'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        'todayBtn' => true,
                                    ]
                                ]);
                                ?>
                                <?= $form->field($mdlPago, "[{$index}]valor_pago")->textInput() ?>                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
        <!-- FIN CONSOLIDADO DE PAGOS -->

        <!--DEMANDADOS / CODEUDORES -->
        <div class="row-field">            
            <?php
            $listDeudoresyCode = \app\models\Deudores::find()
                    ->select([
                        'nombre',
                        'nombre_codeudor_1',
                        'documento_codeudor_1',
                        'direccion_codeudor_1',
                        'email_codeudor_1',
                        'telefono_codeudor_1',
                        'nombre_codeudor_2',
                        'documento_codeudor_2',
                        'direccion_codeudor_2',
                        'email_codeudor_2',
                        'telefonol_codeudor_2'
                    ])
                    ->where(['id' => $model->deudor_id])
                    ->all();

            $elRestoDeudores = \app\models\Deudores::find()
                    ->select([
                        'nombre'
                    ])
                    ->orderBy("nombre ASC")
                    ->all();

            $listDeudores = [];
            if (!empty($listDeudoresyCode)) {

                $listDeudores[$listDeudoresyCode[0]->nombre] = "{$listDeudoresyCode[0]->nombre}";

                if (!empty($listDeudoresyCode[0]->nombre_codeudor_1)) {
                    $listDeudores[$listDeudoresyCode[0]->nombre_codeudor_1] = "{$listDeudoresyCode[0]->nombre_codeudor_1} ({$listDeudoresyCode[0]->direccion_codeudor_1}, {$listDeudoresyCode[0]->email_codeudor_1})";
                }

                if (!empty($listDeudoresyCode[0]->nombre_codeudor_2)) {
                    $listDeudores[$listDeudoresyCode[0]->nombre_codeudor_2] = "{$listDeudoresyCode[0]->nombre_codeudor_2} ({$listDeudoresyCode[0]->direccion_codeudor_2}, {$listDeudoresyCode[0]->email_codeudor_2})";
                }
            } else {
                $listDeudores = [];
            }

            if (!empty($elRestoDeudores)) {

                foreach ($elRestoDeudores as $restoDeudor) {
                    $listDeudores[$restoDeudor->nombre] = "{$restoDeudor->nombre}";
                }
                echo $form->field($model, 'jur_demandados')->widget(Select2::className(), [
                    'pluginOptions' => [
                        'tags' => true,
                        'multiple' => true,
                    ],
                    'data' => $listDeudores,
                ]);
            }
            ?>
            <!--<div style="height: 300px; overflow: auto; margin-bottom: 50px;">-->
            <?php /* =
              $form->field($model, 'jur_demandados', [
              "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_demandados']) . "{label}\n{input}\n{hint}\n{error}",
              ])->checkboxList($listDeudores)
             */ ?>
            <!--</div>-->
        </div>

        <!-- TIPO DE PROCESO -->
        <div class="row-field">
            <?php
            $tipoProcesosList = yii\helpers\ArrayHelper::map(
                            \app\models\TipoProcesos::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'jur_tipo_proceso_id', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_tipo_proceso_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->dropDownList($tipoProcesosList, ['prompt' => '- Seleccion un tipo de proceso -', 'id' => 'tipo-proceso-id']) ?>
            <?=
            $form->field($model, 'jur_etapas_procesal_id', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_etapas_procesal_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'etapa-procesal-id'],
                'data' => [$model->jur_etapas_procesal_id => $model->jurEtapasProcesal->nombre ?? 'default'],
                'pluginOptions' => [
                    'depends' => ['tipo-proceso-id'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una etapa procesal -',
                    'url' => Url::to(['/etapas-procesales/etapasprocesalesporprocesoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'jur_fecha_etapa_procesal')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
        </div>

        <!-- JUZGADO -->
        <div class="row-field">
            <h4 class="radicadoText">Radicado<a class="vaciarRadicado" data-radicado-numero="1" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></h4>
            <?php
            $departamentos = yii\helpers\ArrayHelper::map(
                            \app\models\Departamentos::find()
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'jur_departamento_id', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_departamento_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->dropDownList($departamentos, ['prompt' => '- Seleccion un departamento -', 'id' => 'departamento-id']) ?>
            <?=
            $form->field($model, 'jur_ciudad_id', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_ciudad_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'ciudad-id'],
                'data' => [$model->jur_ciudad_id => 'default'],
                'pluginOptions' => [
                    'depends' => ['departamento-id'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una ciudad -',
                    'url' => Url::to(['/ciudades/ciudadesxdepartamentoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_id', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'jurisdiccion-competent-id'],
                'data' => [$model->jur_jurisdiccion_competent_id => 'default'],
                'pluginOptions' => [
                    'depends' => ['ciudad-id'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una jurisdicción -',
                    'url' => Url::to(['/jurisdicciones-competentes/jurisdiccionesxciudadid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_caso_especial_id', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}",
            ])->dropDownList(['SUPERSOCIEDADES' => 'SUPERSOCIEDADES',
                'PROCURADURÍA' => 'PROCURADURÍA',
                'CENTRO DE CONCILIACIÓN POLICIA NACIONAL' => 'CENTRO DE CONCILIACIÓN POLICIA NACIONAL',
                'CENTRO PRIVADO DE CONCILIACIÓN' => 'CENTRO PRIVADO DE CONCILIACIÓN',
                'OTROS' => 'OTROS'], ['prompt' => '- Seleccione una jurisdiccion -', 'id' => 'jur_jurisdiccion_competent_caso_especial_id'])
            ?>
            <?= $form->field($model, 'jur_juzgado', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_juzgado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'juzgado']) ?>

        </div>

        <!-- RADICADO -->
        <div class="row-field">
            <?=
            $form->field($model, 'jur_anio_radicado', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_anio_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['2008' => '2008', '2009' => '2009', '2010' => '2010',
                '2011' => '2011',
                '2012' => '2012',
                '2013' => '2013',
                '2014' => '2014',
                '2015' => '2015',
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
                '2026' => '2026',
                '2027' => '2027',
                '2028' => '2028',
                '2029' => '2029',
                '2030' => '2030'], ['prompt' => '- Seleccione un año -', 'id' => 'jur_anio_radicado'])
            ?>
            <?= $form->field($model, 'jur_consecutivo_proceso', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_consecutivo_proceso']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['id' => 'jur_consecutivo_proceso']) ?>
            <?=
            $form->field($model, 'jur_instancia_radicado', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_instancia_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['00' => '00', '01' => '01', '02' => '02', '--' => 'Sin instancia'], ['prompt' => '- Seleccione una instancia -', 'id' => 'jur_instancia_radicado'])
            ?>

            <!-- CAMPOS OCULTOS CON LA INFO DE CODIGO ENTIDAD Y ESPECIALIDAD -->
            <?= Html::hiddenInput('codigoDepartamento', "", ['id' => 'codigoDepartamento']); ?>
            <?= Html::hiddenInput('codigoCiudad', "", ['id' => 'codigoCiudad']); ?>
            <?= Html::hiddenInput('codigoEntidad', "", ['id' => 'codigoEntidad']); ?>
            <?= Html::hiddenInput('codigoEspecialidad', "", ['id' => 'codigoEspecialidad']); ?>
            <?= Html::hiddenInput('codigoDespacho', "", ['id' => 'codigoDespacho']); ?>

            <?= $form->field($model, 'jur_radicado', ["options" => ['class' => 'form-group col-md-12'], 'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_radicado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'radicado']) ?>
        </div>

        <div class="row-field">
            <?=
            $form->field($model, 'jur_comentario_radicado_1', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_comentario_radicado_1']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>


        <!-- JUZGADO 2 -->
        <div class="row-field">
            <h4 class="radicadoText">Radicado #2<a class="vaciarRadicado" data-radicado-numero="2" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></h4>
            <?= $form->field($model, 'jur_departamento_id_2', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_departamento_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->dropDownList($departamentos, ['prompt' => '- Seleccion un departamento -', 'id' => 'departamento-id-2']) ?>
            <?=
            $form->field($model, 'jur_ciudad_id_2', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_ciudad_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'ciudad-id-2'],
                'data' => [$model->jur_ciudad_id_2 => 'default'],
                'pluginOptions' => [
                    'depends' => ['departamento-id-2'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una ciudad -',
                    'url' => Url::to(['/ciudades/ciudadesxdepartamentoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_id_2', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'jurisdiccion-competent-id-2'],
                'data' => [$model->jur_jurisdiccion_competent_id_2 => 'default'],
                'pluginOptions' => [
                    'depends' => ['ciudad-id-2'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una jurisdicción -',
                    'url' => Url::to(['/jurisdicciones-competentes/jurisdiccionesxciudadid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_caso_especial_id_2', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}",
            ])->dropDownList(['SUPERSOCIEDADES' => 'SUPERSOCIEDADES',
                'PROCURADURÍA' => 'PROCURADURÍA',
                'CENTRO DE CONCILIACIÓN POLICIA NACIONAL' => 'CENTRO DE CONCILIACIÓN POLICIA NACIONAL',
                'CENTRO PRIVADO DE CONCILIACIÓN' => 'CENTRO PRIVADO DE CONCILIACIÓN',
                'OTROS' => 'OTROS'], ['prompt' => '- Seleccione una jurisdiccion -', 'id' => 'jur_jurisdiccion_competent_caso_especial_id_2'])
            ?>
            <?= $form->field($model, 'jur_juzgado_2', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_juzgado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'juzgado-2']) ?>

        </div>     

        <!-- RADICADO 2 -->
        <div class="row-field">
            <?=
            $form->field($model, 'jur_anio_radicado_2', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_anio_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['2010' => '2010',
                '2011' => '2011',
                '2012' => '2012',
                '2013' => '2013',
                '2014' => '2014',
                '2015' => '2015',
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
                '2026' => '2026',
                '2027' => '2027',
                '2028' => '2028',
                '2029' => '2029',
                '2030' => '2030'], ['prompt' => '- Seleccione un año -', 'id' => 'jur_anio_radicado_2'])
            ?>
            <?= $form->field($model, 'jur_consecutivo_proceso_2', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_consecutivo_proceso']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['id' => 'jur_consecutivo_proceso_2']) ?>
            <?=
            $form->field($model, 'jur_instancia_radicado_2', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_instancia_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['00' => '00', '01' => '01', '02' => '02', '--' => 'Sin instancia'], ['prompt' => '- Seleccione una instancia -', 'id' => 'jur_instancia_radicado_2'])
            ?>

            <!-- CAMPOS OCULTOS CON LA INFO DE CODIGO ENTIDAD Y ESPECIALIDAD -->
            <?= Html::hiddenInput('codigoDepartamento_2', "", ['id' => 'codigoDepartamento_2']); ?>
            <?= Html::hiddenInput('codigoCiudad_2', "", ['id' => 'codigoCiudad_2']); ?>
            <?= Html::hiddenInput('codigoEntidad_2', "", ['id' => 'codigoEntidad_2']); ?>
            <?= Html::hiddenInput('codigoEspecialidad_2', "", ['id' => 'codigoEspecialidad_2']); ?>
            <?= Html::hiddenInput('codigoDespacho_2', "", ['id' => 'codigoDespacho_2']); ?>

            <?= $form->field($model, 'jur_radicado_2', ["options" => ['class' => 'form-group col-md-12'], 'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_radicado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'radicado-2']) ?>
        </div>

        <div class="row-field">
            <?=
            $form->field($model, 'jur_comentario_radicado_2', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_comentario_radicado_2']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>

        <!-- JUZGADO 3 -->
        <div class="row-field">   
            <h4 class="radicadoText">Radicado #3<a class="vaciarRadicado" data-radicado-numero="3" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></h4>
            <?= $form->field($model, 'jur_departamento_id_3', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_departamento_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->dropDownList($departamentos, ['prompt' => '- Seleccion un departamento -', 'id' => 'departamento-id-3']) ?>
            <?=
            $form->field($model, 'jur_ciudad_id_3', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_ciudad_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'ciudad-id-3'],
                'data' => [$model->jur_ciudad_id_3 => 'default'],
                'pluginOptions' => [
                    'depends' => ['departamento-id-3'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una ciudad -',
                    'url' => Url::to(['/ciudades/ciudadesxdepartamentoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_id_3', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}\n"])->widget(DepDrop::classname(), [
                'options' => ['id' => 'jurisdiccion-competent-id-3'],
                'data' => [$model->jur_jurisdiccion_competent_id_3 => 'default'],
                'pluginOptions' => [
                    'depends' => ['ciudad-id-3'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una jurisdicción -',
                    'url' => Url::to(['/jurisdicciones-competentes/jurisdiccionesxciudadid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'jur_jurisdiccion_competent_caso_especial_id_3', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_jurisdiccion_competent_id']) . "{label}\n{input}\n{hint}\n{error}",
            ])->dropDownList(['SUPERSOCIEDADES' => 'SUPERSOCIEDADES',
                'PROCURADURÍA' => 'PROCURADURÍA',
                'CENTRO DE CONCILIACIÓN POLICIA NACIONAL' => 'CENTRO DE CONCILIACIÓN POLICIA NACIONAL',
                'CENTRO PRIVADO DE CONCILIACIÓN' => 'CENTRO PRIVADO DE CONCILIACIÓN',
                'OTROS' => 'OTROS'], ['prompt' => '- Seleccione una jurisdiccion -', 'id' => 'jur_jurisdiccion_competent_caso_especial_id_3'])
            ?>
            <?= $form->field($model, 'jur_juzgado_3', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_juzgado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'juzgado-3']) ?>

        </div>

        <!-- RADICADO 3 -->
        <div class="row-field">            
            <?=
            $form->field($model, 'jur_anio_radicado_3', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_anio_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['2010' => '2010',
                '2011' => '2011',
                '2012' => '2012',
                '2013' => '2013',
                '2014' => '2014',
                '2015' => '2015',
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
                '2026' => '2026',
                '2027' => '2027',
                '2028' => '2028',
                '2029' => '2029',
                '2030' => '2030'], ['prompt' => '- Seleccione un año -', 'id' => 'jur_anio_radicado_3'])
            ?>
            <?= $form->field($model, 'jur_consecutivo_proceso_3', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_consecutivo_proceso']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['id' => 'jur_consecutivo_proceso_3']) ?>
            <?=
            $form->field($model, 'jur_instancia_radicado_3', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_instancia_radicado']) . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList(['00' => '00', '01' => '01', '02' => '02', '--' => 'Sin instancia'], ['prompt' => '- Seleccione una instancia -', 'id' => 'jur_instancia_radicado_3'])
            ?>

            <!-- CAMPOS OCULTOS CON LA INFO DE CODIGO ENTIDAD Y ESPECIALIDAD -->
            <?= Html::hiddenInput('codigoDepartamento_3', "", ['id' => 'codigoDepartamento_3']); ?>
            <?= Html::hiddenInput('codigoCiudad_3', "", ['id' => 'codigoCiudad_3']); ?>
            <?= Html::hiddenInput('codigoEntidad_3', "", ['id' => 'codigoEntidad_3']); ?>
            <?= Html::hiddenInput('codigoEspecialidad_3', "", ['id' => 'codigoEspecialidad_3']); ?>
            <?= Html::hiddenInput('codigoDespacho_3', "", ['id' => 'codigoDespacho_3']); ?>

            <?= $form->field($model, 'jur_radicado_3', ["options" => ['class' => 'form-group col-md-12'], 'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_radicado']) . "{label}\n{input}\n{hint}\n{error}\n"])->textInput(['readOnly' => true, 'id' => 'radicado-3']) ?>
        </div>

        <div class="row-field">
            <?=
            $form->field($model, 'jur_comentario_radicado_3', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_comentario_radicado_3']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>

        <!-- GESTIONES JURIDICAS -->
        <div class="row-field gestion-juridica">
            <?=
            $form->field($model, 'jur_gestion_juridica', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['jur_gestion_juridica']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
            <?=
            $form->field($model, 'jur_fecha_gestion_juridica')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
            <?php if (!empty($model->jur_gestiones_juridicas)): ?>
                <?php foreach ($model->jur_gestiones_juridicas as $gestion) : ?>
                    <div class="col-md-12">
                        <blockquote>
                            <?= nl2br($gestion->descripcion_gestion); ?>
                            <small><?= $gestion->usuario_gestion; ?> el <cite title="Source Title"><?= $gestion->fecha_gestion; ?></cite></small>
                        </blockquote>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<!-- CARPETA GOOGLE DRIVE -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">DOCUMENTOS</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'carpeta', [
                "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['carpeta']) . "{label}\n{input}\n{hint}\n{error}",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textInput(['maxlength' => true])
            ?>
            <?php
            if (!$model->isNewRecord && !empty($model->carpeta)) {
                $url = 'https://drive.google.com/open?id=' . $model->carpeta;
                echo Html::a($url, $url, ['target' => '_blank']);
            }
            ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- TAREAS -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">TAREAS</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <div class="row-field col-md-12">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_tareas', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelTareas[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'descripcion',
                    'fecha_esperada',
                    'user_id'
                ],
            ]);
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="flaticon-coins"></i> Tareas
                    <button type="button" class="pull-right add-item btn btn-primary btn-xs"><i class="flaticon-add"></i> Agregar tarea</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($modelTareas as $index => $mdlTarea): ?>

                        <?php $enable = $mdlTarea->jefe_id == Yii::$app->user->identity->getId() || Yii::$app->user->identity->isSuperAdmin(); ?>
                        <?php $disable = $mdlTarea->jefe_id != Yii::$app->user->identity->getId() && !Yii::$app->user->identity->isSuperAdmin(); ?>
                        <?php
                        if ($mdlTarea->user_id == Yii::$app->user->identity->getId() && $mdlTarea->estado == '0') {
                            $arrDisableEstado = ['disabled' => false, 'label' => false];
                        } else {
                            $arrDisableEstado = ['disabled' => true, 'label' => false];
                        }
                        $asignado = $mdlTarea->user_id != Yii::$app->user->identity->getId()
                        ?>

                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-tareas">
                                    Tarea: <?= ($index + 1) ?>
                                </span>

                                <!-- SOLO EL JEFE Y EL SUPER ADMINISTRADOR PUEDE BORRAR TAREAS -->
                                <button type="button" 
                                        style="display: <?= $disable ? 'none' : 'inline' ?>"
                                        class="pull-right remove-item btn btn-danger btn-xs removeTarea">
                                    <i class="flaticon-circle"></i>
                                </button>

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$mdlTarea->isNewRecord) {
                                    echo Html::activeHiddenInput($mdlTarea, "[{$index}]id");
                                }
                                ?>
                                <?=
                                        $form
                                        ->field($mdlTarea, "[{$index}]estado", ['options' => ['class' => 'form-group col-md-1', 'style' => 'margin-top:20px']])
                                        ->checkbox($arrDisableEstado)
                                ?>
                                <?=
                                $form->field($mdlTarea, "[{$index}]fecha_esperada", [
                                    'options' => ['class' => 'form-group col-md-3']
                                ])->widget(DatePicker::classname(), [
                                    'options' => [
                                        'placeholder' => '- Ingrese una fecha --',
                                        'disabled' => $disable
                                    ],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        'todayBtn' => true,
                                    ]
                                ]);
                                ?>
                                <?=
                                        $form
                                        ->field($mdlTarea, "[{$index}]descripcion", ['options' => ['class' => 'form-group col-md-4']])
                                        ->textInput([
                                            'readonly' => $disable
                                        ])
                                ?>
                                <?php if (!$model->isNewRecord) : ?>
                                    <?php
                                    $userList["COLABORADORES"] = \yii\helpers\ArrayHelper::map(
                                                    \app\models\ProcesosXColaboradores::find()
                                                            ->with('user')
                                                            ->where(['proceso_id' => $model->id])
                                                            ->all(), 'user_id', 'user.name');
                                    $userList["LIDER"][$model->jefe->id] = $model->jefe->name;
                                    ?>


                                    <?=
                                            $form->field($mdlTarea, "[{$index}]user_id",
                                                    ['options' => ['class' => 'form-group col-md-4']])
                                            ->dropDownList(
                                                    $userList,
                                                    [
                                                        'prompt' => '- Seleccion un colaborador -',
                                                        'disabled' => $disable
                                                    ]
                                    );
                                    ?>
                                <?php endif; ?>
    <?= Html::activeHiddenInput($mdlTarea, "[{$index}]jefe_id"); ?>
                            </div>
                        </div>
<?php endforeach; ?>
                </div>
            </div>
<?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>

<!-- ESTADO DE RECUPERACIÓN -->
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">ESTADO DE RECUPERACIÓN</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div style="display: none;" class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_pretenciones', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['estrec_pretenciones']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_probabilidad_recuperacion', ['template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['estrec_probabilidad_recuperacion']) . "{label}\n{input}\n{hint}\n{error}\n"])->dropDownList([
                '25%' => '25%',
                '50%' => '50%',
                '75%' => '75%',
                '100%' => '100%'
                    ], ['prompt' => '- Seleccion un porcentaje -'])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_tiempo_recuperacion', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['estrec_tiempo_recuperacion']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_comentarios', [
                'template' => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['estrec_comentarios']) . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
        <?= Html::submitButton('<i class="flaticon-paper-plane" style="font-size: 15px"></i> ' . 'Guardar', ['class' => 'btn btn-primary']) ?>
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default pull-right']) ?>
<?php endif; ?> 
    </div>
</div>

<!-- FIN FORMULARIO -->
<?php ActiveForm::end(); ?>