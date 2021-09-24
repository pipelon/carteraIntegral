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

<!-- BOTON VOLVER -->
<div class="procesos-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
</div>

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
                    "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}",
                    'options' => ['class' => 'form-group col-md-12']
                ])->dropDownList($plataformas, ['prompt' => '- Seleccione una plataforma -'])
                ?>
            </div>
        </div>
    </div>
</div>

<!-- COLABORADORES -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">LÍDERES Y COLABORADORES</h3>
    </div>
    <div class="box-body">
        <?php
        $lideresList = yii\helpers\ArrayHelper::map(
                        \Yii::$app->user->identity->getUserNamesByRole("Lider")
                        , 'id', 'name');
        $dataList = yii\helpers\ArrayHelper::map(
                        \Yii::$app->user->identity->getUserNamesByRole("Colaborador")
                        , 'id', 'name');
        ?>

        <?=
        $form->field($model, 'jefe_id')->dropDownList($lideresList, ['prompt' => '- Seleccione un líder -'])
        ?>

        <?=
        $form->field($model, 'colaboradores')->widget(Select2::classname(), [
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
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">ESTUDIO PRE-JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
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
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList($tipoCasosList, ['prompt' => '- Seleccione un tipo de caso -'])
            ?>
        </div>
        <div class="row-field">
            <?=
                    $form->field($model, 'prejur_carta_enviada', [
                        "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}"
                    ])->dropDownList(
                            ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                            [
                                'prompt' => '- Seleccione -',
                            ]
                    )
            ?>
            <?=
            $form->field($model, 'prejur_comentarios_carta', [
                'template' => "{label}\n{input}\n{hint}\n{error}\n",
            ])->textInput(['maxlength' => true])
            ?>
        </div>
        <div class="row-field">
            <?=
                    $form->field($model, 'prejur_llamada_realizada', [
                        "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}"
                    ])->dropDownList(
                            ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                            [
                                'prompt' => '- Seleccione -',
                            ]
                    )
            ?>
            <?=
            $form->field($model, 'prejur_comentarios_llamada', [
                'template' => "{label}\n{input}\n{hint}\n{error}\n",
            ])->textInput(['maxlength' => true])
            ?>
        </div>
        <div class="row-field">
            <?=
                    $form->field($model, 'prejur_visita_domiciliaria', [
                        "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}"
                    ])->dropDownList(
                            ['SI' => 'SI', 'NO' => 'NO', 'N/A' => 'N/A'],
                            [
                                'prompt' => '- Seleccione -',
                            ]
                    )
            ?>
            <?=
            $form->field($model, 'prejur_comentarios_visita', [
                'template' => "{label}\n{input}\n{hint}\n{error}\n",
            ])->textInput(['maxlength' => true])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_rama_judicial', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_entidad_reguladora', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- ESTUDIO DE BIENES -->
        <div class="row-field">
            <?php
            $bienesList = yii\helpers\ArrayHelper::map(
                            \app\models\Bienes::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'prejur_estudio_bienes', [
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}",
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
            $form->field($model, 'prejur_concepto_viabilidad', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- GESTIONES PRE JURIDICAS -->
        <div class="row-field gestion-prejuridica">
            <?=
            $form->field($model, 'prejur_gestion_prejuridica', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
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
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
    </div>
</div>

<!-- JURIDICO -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
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
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}",
            ])->checkboxList($docActList)
            ?>
        </div>
        <div class="row-field">
            <?= $form->field($model, 'jur_valor_activacion')->textInput() ?>
            <?= $form->field($model, 'jur_saldo_actual')->textInput() ?>
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

        <div class="row-field">
            <?php
            $tipoProcesosList = yii\helpers\ArrayHelper::map(
                            \app\models\TipoProcesos::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'jur_tipo_proceso_id')->dropDownList($tipoProcesosList, ['id' => 'tipo-proceso-id']) ?>
            <?=
            $form->field($model, 'jur_etapas_procesal_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'etapa-procesal-id'],
                'data' => [$model->jur_etapas_procesal_id => 'default'],
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

        <!-- JUZGADO -->
        <div class="row-field">
            <?php
            $departamentos = yii\helpers\ArrayHelper::map(
                            \app\models\Departamentos::find()
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'jur_departamento_id')->dropDownList($departamentos, ['id' => 'departamento-id']) ?>
            <?=
            $form->field($model, 'jur_ciudad_id')->widget(DepDrop::classname(), [
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
            $form->field($model, 'jur_jurisdiccion_competent_id')->widget(DepDrop::classname(), [
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
            <?= $form->field($model, 'jur_juzgado')->textInput(['readOnly' => true, 'id' => 'juzgado']) ?>
        </div>
    </div>
</div>

<!-- CARPETA GOOGLE DRIVE -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Documentos</h3>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'carpeta', [
                'template' => "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textInput(['maxlength' => true])
            ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- TAREAS -->
<div class="box box-primary">
    <div class="box-header with-border">
        Tareas
    </div>
    <div class="box-body">
        <div class="row-field col-md-12">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_tareas', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
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
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Estado de recuperación</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Colapsar">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_pretenciones', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_probabilidad_recuperacion')->dropDownList([
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
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'estrec_comentarios', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- ESTADO DEL PROCESO -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Estado del proceso</h3>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?php
            $estadosProcesoList = yii\helpers\ArrayHelper::map(
                            \app\models\EstadosProceso::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'estado_proceso_id')->dropDownList($estadosProcesoList, ['prompt' => '- Seleccion un estado -']) ?>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
        <?= Html::submitButton('<i class="flaticon-paper-plane" style="font-size: 20px"></i> ' . 'Guardar', ['class' => 'btn btn-primary']) ?>
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default pull-right']) ?>
        <?php endif; ?> 
    </div>
</div>

<!-- FIN FORMULARIO -->
<?php ActiveForm::end(); ?>