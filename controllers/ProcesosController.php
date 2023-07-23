<?php

namespace app\controllers;

use Yii;
use app\models\Procesos;
use app\models\ProcesosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ConsolidadoPagosJuridicos;
use yii\helpers\ArrayHelper;

/**
 * ProcesosController implements the CRUD actions for Procesos model.
 */
class ProcesosController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Procesos models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProcesosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $exportDataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $exportDataProvider->pagination = false;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'exportDataProvider' => $exportDataProvider,
        ]);
    }

    /**
     * Displays a single Procesos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        // SI SOY USUARIO TIPO CLIENTE Y NO PUEDO VER ESTE CLIENTE RETURN
        if (Yii::$app->user->identity->isCliente()) {
            $clientesIds = Yii::$app->user->identity->getClientsByUser();
            $ids = array_column($clientesIds, 'id');
            if (!in_array($model->cliente_id, $ids)) {
                return $this->redirect(['index']);
            }
        }

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
        $pagos = $model->consolidadoPagosJuridicos;

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
        $acuerdoPagos = $model->consolidadoPagosPrejuridicos;

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
        $valoresActivacion = $model->valoresActivacionJuridico;

        //TAREAS ACTUALES PARA MOSTRAR
        $tareas = $model->tareas;

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'pagos' => $pagos,
                    'acuerdoPagos' => $acuerdoPagos,
                    'tareas' => $tareas,
                    'valoresActivacion' => $valoresActivacion
        ]);
    }

    /**
     * Creates a new Procesos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Procesos();
        //MODELO DE CONSOLIDADO DE PAGOS
        $modelAcuerdoPagos = [new \app\models\ConsolidadoPagosPrejuridicos];
        //MODELO DE CONSOLIDADO DE PAGOS
        $modelPagos = [new ConsolidadoPagosJuridicos];
        //MODELO DE TAREAS
        $modelTareas = [new \app\models\Tareas];
        //MODELO DE ACTIVACIONES
        $modelVActivaciones = [new \app\models\ValoresActivacionJuridico()];

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO PRINCIPAL DEL PROCESO
            if ($model->save()) {

                //LOG
                $mensaje = "Un nuevo proceso con ID #'{$model->id}' ha sido creado.";
                \Yii::info($mensaje, "cartera");

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COLABORADORES
                if (!empty($model->colaboradores)) {
                    foreach ($model->colaboradores as $colaborador) {
                        $proXcol = new \app\models\ProcesosXColaboradores();
                        $proXcol->proceso_id = $model->id;
                        $proXcol->user_id = $colaborador;
                        $proXcol->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS ESTUDIOS DE BIENES
                if (!empty($model->prejur_estudio_bienes)) {
                    foreach ($model->prejur_estudio_bienes as $bien) {
                        $bieXpro = new \app\models\BienesXProceso();
                        $bieXpro->proceso_id = $model->id;
                        $bieXpro->bien_id = $bien;
                        $bieXpro->comentario = $model->prejur_comentarios_estudio_bienes[$bien];
                        $bieXpro->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBE GUARDAR LA NUEVA GESTION PRE JURIDICA
                if (!empty($model->prejur_gestion_prejuridica)) {
                    $gestPreJur = new \app\models\GestionesPrejuridicas();
                    $gestPreJur->proceso_id = $model->id;
                    $gestPreJur->fecha_gestion = date('Y-m-d H:i:s');
                    $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                    $gestPreJur->descripcion_gestion = $model->prejur_gestion_prejuridica;
                    $gestPreJur->save();
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS DOCUMENTOS DE ACTIVACION
                if (!empty($model->jur_documentos_activacion)) {
                    foreach ($model->jur_documentos_activacion as $doc) {
                        $docXpro = new \app\models\DocactivacionXProceso();
                        $docXpro->proceso_id = $model->id;
                        $docXpro->documento_activacion_id = $doc;
                        $docXpro->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS DEUDORES
                if (!empty($model->jur_demandados)) {
                    foreach ($model->jur_demandados as $id => $demandado) {
                        $demXpro = new \app\models\DemandadosXProceso();
                        $demXpro->proceso_id = $model->id;
                        $demXpro->demandado_id = $id;
                        $demXpro->nombre = $demandado;
                        $demXpro->save();
                    }
                } else {
                    $demXpro = new \app\models\DemandadosXProceso();
                    $demXpro->proceso_id = $model->id;
                    $demXpro->demandado_id = $model->deudor->nombre;
                    $demXpro->nombre = $model->deudor->nombre;
                    $demXpro->save();
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COONSOLIDADOS DE PAGO
                if (isset($_POST['ConsolidadoPagosJuridicos'])) {
                    foreach ($_POST['ConsolidadoPagosJuridicos'] as $pago) {
                        $mdlPagos = new ConsolidadoPagosJuridicos();
                        $mdlPagos->valor_pago = $pago['valor_pago'];
                        $mdlPagos->fecha_pago = $pago['fecha_pago'];
                        $mdlPagos->proceso_id = $model->id;
                        $mdlPagos->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COONSOLIDADOS DE PAGO
                if (isset($_POST['ConsolidadoPagosPrejuridicos'])) {
                    foreach ($_POST['ConsolidadoPagosPrejuridicos'] as $pago) {
                        $mdlPagos = new \app\models\ConsolidadoPagosPrejuridicos();
                        $mdlPagos->valor_acuerdo_pago = $pago['valor_acuerdo_pago'];
                        $mdlPagos->fecha_acuerdo_pago = $pago['fecha_acuerdo_pago'];
                        $mdlPagos->descripcion = $pago['descripcion'];
                        $mdlPagos->fecha_pago_realizado = $pago['fecha_pago_realizado'];
                        $mdlPagos->valor_pagado = $pago['valor_pagado'];
                        $mdlPagos->proceso_id = $model->id;
                        $mdlPagos->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBE GUARDAR LA NUEVA GESTION JURIDICA
                if (!empty($model->jur_gestion_juridica)) {
                    $gestPreJur = new \app\models\GestionesJuridicas();
                    $gestPreJur->proceso_id = $model->id;
                    $gestPreJur->fecha_gestion = !empty($model->jur_fecha_gestion_juridica) ? $model->jur_fecha_gestion_juridica : date('Y-m-d H:i:s');
                    $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                    $gestPreJur->descripcion_gestion = $model->jur_gestion_juridica;
                    $gestPreJur->save();
                }

                //SI FUE UN AUTOGUARDADO ME QUEDO EN LA PAGINA SIN REFRESCAR
                if (isset($_POST["typeSave"]) && $_POST["typeSave"] == 'autoSave') {
                    return;
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos,
                            'modelAcuerdoPagos' => (empty($modelAcuerdoPagos)) ? [new \app\models\ConsolidadoPagosPrejuridicos] : $modelAcuerdoPagos,
                            'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas,
                            'modelVActivaciones' => (empty($modelVActivaciones)) ? [new \app\models\ValoresActivacionJuridico] : $modelVActivaciones
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos,
                        'modelAcuerdoPagos' => (empty($modelAcuerdoPagos)) ? [new \app\models\ConsolidadoPagosPrejuridicos] : $modelAcuerdoPagos,
                        'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas,
                        'modelVActivaciones' => (empty($modelVActivaciones)) ? [new \app\models\ValoresActivacionJuridico] : $modelVActivaciones
            ]);
        }
    }

    /**
     * Updates an existing Procesos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $filter = "") {
        $model = $this->findModel($id);
        
        /*
         * *********************************************************************
         * SOLO SI ES UNO DE LOS COLABORADORES, EL LIDER O EL SUPER 
         * ADMINISTRADOR, PUEDE EDITAR UN PROCESO
         */
        $colaboradores = array_column($model->procesosXColaboradores, 'user_id');
        //ID usuario logueado
        $userId = (int) \Yii::$app->user->id;
        $canEdit = in_array($userId, $colaboradores) ||
                $userId == $model->jefe_id ||
                Yii::$app->user->identity->isSuperAdmin();
        //Puede editar
        if (!$canEdit) {
            return $this->redirect(['index']);
        }
        //**********************************************************************
        //COLABORADORES ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->colaboradores = ArrayHelper::map(
                        $model->procesosXColaboradores, 'user_id', 'user_id'
        );

        //BIENES ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->prejur_estudio_bienes = ArrayHelper::map(
                        $model->bienesXProcesos, 'bien_id', 'bien_id'
        );

        //COMENTARIO BIENES ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->prejur_comentarios_estudio_bienes = ArrayHelper::map(
                        $model->bienesXProcesos, 'bien_id', 'comentario'
        );

        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->prejur_gestiones_prejuridicas = $model->gestionesPrejuridicas;

        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->jur_gestiones_juridicas = $model->gestionesJuridicas;

        //DOCUMENTOS DE ACTIVACION ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->jur_documentos_activacion = ArrayHelper::map(
                        $model->docactivacionXProcesos, 'documento_activacion_id', 'documento_activacion_id'
        );

        //DEMANDADOS ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->jur_demandados = ArrayHelper::map(
                        $model->demandadosXProceso, 'demandado_id', 'demandado_id'
        );

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelPagos = $model->consolidadoPagosJuridicos;

        //VALORES DE ACTIVACION DEL JURIDICO
        $modelVActivaciones = $model->valoresActivacionJuridico;

        //ACUERDO DE PAGOS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelAcuerdoPagos = $model->consolidadoPagosPrejuridicos;

        //TAREAS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelTareas = $model->tareas;

        //ACTUAL TIPO DE PROCESO PARA COMPRAR CUANDO SEA CAMBIADO
        $old_jur_tipo_proceso_id = $model->jur_tipo_proceso_id;
        //ACTUAL ESTAPA PROCESAL PARA COMPRAR CUANDO SEA CAMBIADA
        $old_jur_etapas_procesal_id = $model->jur_etapas_procesal_id;

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
            if ($model->save()) {

                //LOG
                $mensaje = "El proceso #{$id} ha sido cambiado.";
                \Yii::info($mensaje, "cartera");

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS COLABORADORES ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->colaboradores)) {
                    $oldIDs = ArrayHelper::map($model->procesosXColaboradores, 'user_id', 'user_id');
                    $deletedColIDs = array_merge(array_diff($oldIDs, $model->colaboradores), array_diff($model->colaboradores, $oldIDs));
                    if (!empty($deletedColIDs)) {
                        \app\models\ProcesosXColaboradores::deleteAll(['proceso_id' => $model->id]);
                        foreach ($model->colaboradores as $colaborador) {
                            $proXcol = new \app\models\ProcesosXColaboradores();
                            $proXcol->proceso_id = $model->id;
                            $proXcol->user_id = $colaborador;
                            $proXcol->save();
                        }

                        //LOG
                        $mensaje = "Los colaboradores del proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS BIENES ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->prejur_estudio_bienes)) {
                    $oldIDs = ArrayHelper::map($model->bienesXProcesos, 'bien_id', 'bien_id');
                    $deletedBienIDs = array_merge(array_diff($oldIDs, $model->prejur_estudio_bienes), array_diff($model->prejur_estudio_bienes, $oldIDs));
                    if (!empty($deletedBienIDs)) {
                        \app\models\BienesXProceso::deleteAll(['proceso_id' => $model->id]);
                        foreach ($model->prejur_estudio_bienes as $bien) {
                            $bieXpro = new \app\models\BienesXProceso();
                            $bieXpro->proceso_id = $model->id;
                            $bieXpro->bien_id = $bien;
                            $bieXpro->comentario = $model->prejur_comentarios_estudio_bienes[$bien];
                            $bieXpro->save();
                        }

                        //LOG
                        $mensaje = "Los estudios de bienes del estado prejuridico en el proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }
                // COMENTARIOS
                if (!empty($model->prejur_comentarios_estudio_bienes)) {
                    $oldIDs = ArrayHelper::map($model->bienesXProcesos, 'bien_id', 'comentario');
                    $deletedComBienIDs = array_merge(array_diff($oldIDs, array_filter($model->prejur_comentarios_estudio_bienes)), array_diff(array_filter($model->prejur_comentarios_estudio_bienes), $oldIDs));
                    if (!empty($deletedComBienIDs)) {
                        \app\models\BienesXProceso::deleteAll(['proceso_id' => $model->id]);
                        foreach ($model->prejur_estudio_bienes as $bien) {
                            $bieXpro = new \app\models\BienesXProceso();
                            $bieXpro->proceso_id = $model->id;
                            $bieXpro->bien_id = $bien;
                            $bieXpro->comentario = $model->prejur_comentarios_estudio_bienes[$bien];
                            $bieXpro->save();
                        }
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBE GUARDAR LA NUEVA GESTION PRE JURIDICA
                if (!empty($model->prejur_gestion_prejuridica)) {
                    $gestPreJur = new \app\models\GestionesPrejuridicas();
                    $gestPreJur->proceso_id = $model->id;
                    $gestPreJur->fecha_gestion = date('Y-m-d H:i:s');
                    $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                    $gestPreJur->descripcion_gestion = $model->prejur_gestion_prejuridica;
                    $gestPreJur->save();
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS DOCUMENTOS DE ACTIVACION ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->jur_documentos_activacion)) {
                    $oldIDs = ArrayHelper::map($model->docactivacionXProcesos, 'documento_activacion_id', 'documento_activacion_id');
                    $deletedDocIDs = array_merge(array_diff($oldIDs, $model->jur_documentos_activacion), array_diff($model->jur_documentos_activacion, $oldIDs));
                    if (!empty($deletedDocIDs)) {
                        \app\models\DocactivacionXProceso::deleteAll(['proceso_id' => $model->id]);
                        foreach ($model->jur_documentos_activacion as $doc) {
                            $docXpro = new \app\models\DocactivacionXProceso();
                            $docXpro->proceso_id = $model->id;
                            $docXpro->documento_activacion_id = $doc;
                            $docXpro->save();
                        }
                    }

                    //LOG
                    $mensaje = "Los documentos de activación del proceso #{$id} han sido cambiados.";
                    \Yii::info($mensaje, "cartera");
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS DEMANDADOS ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->jur_demandados)) {

                    $oldIDs = ArrayHelper::map($model->demandadosXProceso, 'demandado_id', 'demandado_id');
                    $deletedDocIDs = array_merge(array_diff($oldIDs, $model->jur_demandados), array_diff($model->jur_demandados, $oldIDs));
                    if (!empty($deletedDocIDs)) {
                        \app\models\DemandadosXProceso::deleteAll(['proceso_id' => $model->id]);
                        foreach ($model->jur_demandados as $demandado) {
                            $demXpro = new \app\models\DemandadosXProceso();
                            $demXpro->proceso_id = $model->id;
                            $demXpro->demandado_id = $demandado;
                            $demXpro->nombre = $demandado;
                            $demXpro->save();
                        }

                        //LOG
                        $mensaje = "Los demandados del proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COONSOLIDADOS DE PAGO                
                if (isset($_POST['ConsolidadoPagosJuridicos'])) {
                    $oldValues = array_merge(
                            ArrayHelper::map($modelPagos, 'id', 'id'),
                            ArrayHelper::map($modelPagos, 'id', 'valor_pago'),
                            ArrayHelper::map($modelPagos, 'id', 'fecha_pago')
                    );
                    $newValues = array_merge(
                            ArrayHelper::map($_POST['ConsolidadoPagosJuridicos'], 'id', 'id'),
                            ArrayHelper::map($_POST['ConsolidadoPagosJuridicos'], 'id', 'valor_pago'),
                            ArrayHelper::map($_POST['ConsolidadoPagosJuridicos'], 'id', 'fecha_pago')
                    );
                    $deletedPagos = array_merge(array_diff($oldValues, $newValues), array_diff($newValues, $oldValues));
                    if (!empty($deletedPagos)) {
                        ConsolidadoPagosJuridicos::deleteAll(['proceso_id' => $model->id]);
                        foreach ($_POST['ConsolidadoPagosJuridicos'] as $pago) {
                            $mdlPagos = new ConsolidadoPagosJuridicos();
                            $mdlPagos->valor_pago = $pago['valor_pago'];
                            $mdlPagos->fecha_pago = $pago['fecha_pago'];
                            $mdlPagos->proceso_id = $model->id;
                            $mdlPagos->save();
                        }

                        //LOG
                        $mensaje = "Los pagos juridicos del proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS VALORES DE ACTIVACION              
                if (isset($_POST['ValoresActivacionJuridico'])) {
                    $oldValues = array_merge(
                            ArrayHelper::map($modelVActivaciones, 'id', 'id'),
                            ArrayHelper::map($modelVActivaciones, 'id', 'valor')
                    );
                    $newValues = array_merge(
                            ArrayHelper::map($_POST['ValoresActivacionJuridico'], 'id', 'id'),
                            ArrayHelper::map($_POST['ValoresActivacionJuridico'], 'id', 'valor')
                    );
                    $deletedValores = array_merge(array_diff($oldValues, $newValues), array_diff($newValues, $oldValues));
                    if (!empty($deletedValores)) {
                        \app\models\ValoresActivacionJuridico::deleteAll(['proceso_id' => $model->id]);
                        foreach ($_POST['ValoresActivacionJuridico'] as $valor) {
                            $mdlValores = new \app\models\ValoresActivacionJuridico;
                            $mdlValores->valor = $valor['valor'];
                            $mdlValores->fecha = date('Y-m-d H:i:s');
                            $mdlValores->proceso_id = $model->id;
                            $mdlValores->save();
                        }

                        //LOG
                        $mensaje = "Los valores de activación juridicos del proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COONSOLIDADOS DE PAGO 
                if (isset($_POST['ConsolidadoPagosPrejuridicos'])) {
                    \app\models\ConsolidadoPagosPrejuridicos::deleteAll(['proceso_id' => $model->id]);
                    foreach ($_POST['ConsolidadoPagosPrejuridicos'] as $pago) {
                        $mdlPagos = new \app\models\ConsolidadoPagosPrejuridicos();
                        $mdlPagos->valor_acuerdo_pago = $pago['valor_acuerdo_pago'];
                        $mdlPagos->fecha_acuerdo_pago = $pago['fecha_acuerdo_pago'];
                        $mdlPagos->descripcion = $pago['descripcion'];
                        $mdlPagos->fecha_pago_realizado = $pago['fecha_pago_realizado'];
                        $mdlPagos->valor_pagado = $pago['valor_pagado'];
                        $mdlPagos->proceso_id = $model->id;
                        $mdlPagos->save();
                    }
                } else {
                    \app\models\ConsolidadoPagosPrejuridicos::deleteAll(['proceso_id' => $model->id]);
                }
                if ($_POST['Procesos']['prejur_acuerdo_pago'] == 'N/A' || $_POST['Procesos']['prejur_acuerdo_pago'] == 'NO') {
                    \app\models\ConsolidadoPagosPrejuridicos::deleteAll(['proceso_id' => $model->id]);
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LAS TAREAS
                if (isset($_POST['Tareas'])) {

                    $oldValues = array_merge(
                            ArrayHelper::map($modelTareas, 'id', (string) 'id'),
                            ArrayHelper::map($modelTareas, 'id', (string) 'user_id'),
                            ArrayHelper::map($modelTareas, 'id', (string) 'jefe_id'),
                            ArrayHelper::map($modelTareas, 'id', (string) 'fecha_esperada'),
                            ArrayHelper::map($modelTareas, 'id', (string) 'descripcion'),
                            ArrayHelper::map($modelTareas, 'id', (string) 'estado')
                    );
                    $oldValues = array_map('strval', $oldValues);
                    $newValues = array_merge(
                            ArrayHelper::map($_POST['Tareas'], 'id', 'id'),
                            ArrayHelper::map($_POST['Tareas'], 'id', 'user_id'),
                            ArrayHelper::map($_POST['Tareas'], 'id', 'jefe_id'),
                            ArrayHelper::map($_POST['Tareas'], 'id', 'fecha_esperada'),
                            ArrayHelper::map($_POST['Tareas'], 'id', 'descripcion'),
                            ArrayHelper::map($_POST['Tareas'], 'id', 'estado')
                    );
                    $deletedTareas = array_merge(array_diff_assoc($oldValues, $newValues), array_diff_assoc($newValues, $oldValues));

                    if (!empty($deletedTareas)) {
                        \app\models\Tareas::deleteAll(['proceso_id' => $model->id]);
                        foreach ($_POST['Tareas'] as $tarea) {
                            $mdlTareas = new \app\models\Tareas();
                            $mdlTareas->proceso_id = $model->id;
                            $mdlTareas->user_id = $tarea['user_id'];
                            $mdlTareas->jefe_id = $model->jefe_id;
                            $mdlTareas->fecha_esperada = $tarea['fecha_esperada'];
                            $mdlTareas->descripcion = $tarea['descripcion'];
                            $mdlTareas->estado = $tarea['estado'] != '' ? $tarea['estado'] : '0';
                            if ($tarea['estado'] == 1) {
                                $mdlTareas->fecha_finalizacion = date('Y-m-d');
                            }
                            $mdlTareas->save();
                        }

                        //LOG
                        $mensaje = "Las tareas del proceso #{$id} han sido cambiados.";
                        \Yii::info($mensaje, "cartera");
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBE GUARDAR LA NUEVA GESTION PRE JURIDICA
                if (!empty($model->jur_gestion_juridica)) {
                    $gestPreJur = new \app\models\GestionesJuridicas();
                    $gestPreJur->proceso_id = $model->id;
                    $gestPreJur->fecha_gestion = !empty($model->jur_fecha_gestion_juridica) ? $model->jur_fecha_gestion_juridica : date('Y-m-d H:i:s');
                    $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                    $gestPreJur->descripcion_gestion = $model->jur_gestion_juridica;
                    $gestPreJur->save();
                }

                //SI EL TIPO DE PROCESO O LA ETAPA PROCESAL CAMBIO, LO ALMACENO
                if ($old_jur_tipo_proceso_id != $model->jur_tipo_proceso_id ||
                        $old_jur_etapas_procesal_id != $model->jur_etapas_procesal_id) {
                    $histEstaXProc = new \app\models\HistorialEstadosXProceso();
                    $histEstaXProc->proceso_id = $model->id;
                    $histEstaXProc->etapa_procesal_id = $model->jur_etapas_procesal_id;
                    $histEstaXProc->tipo_proceso_id = $model->jur_tipo_proceso_id;
                    $histEstaXProc->created = date('Y-m-d H:i:s');
                    $histEstaXProc->created_by = Yii::$app->user->identity->fullName ?? 'Anónimo';
                    $histEstaXProc->save();
                }

                //SI FUE UN AUTOGUARDADO ME QUEDO EN LA PAGINA SIN REFRESCAR
                if (isset($_POST["typeSave"]) && $_POST["typeSave"] == 'autoSave') {
                    return;
                }                
                
                //return $this->redirect(['view', 'id' => $model->id]);                
                $redirect = !empty($filter) ? "index?" . base64_decode($filter) : "index";
                return $this->redirect([$redirect]);
                
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos,
                        'modelAcuerdoPagos' => (empty($modelAcuerdoPagos)) ? [new \app\models\ConsolidadoPagosPrejuridicos] : $modelAcuerdoPagos,
                        'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas,
                        'modelVActivaciones' => (empty($modelVActivaciones)) ? [new \app\models\ValoresActivacionJuridico] : $modelVActivaciones
            ]);
        }
    }

    public function actionViewSummaryPrejuridico($id) {
        $model = $this->findModel($id);
        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->prejur_gestiones_prejuridicas = $model->gestionesPrejuridicas;

        if (Yii::$app->getRequest()->isAjax) {

            if ($model->load(Yii::$app->request->post())) {

                if (!empty($model->prejur_gestion_prejuridica)) {
                    if (isset($_POST["CommentEditId"])) {
                        $gestPreJur = \app\models\GestionesPrejuridicas::findOne($_POST["CommentEditId"]);
                        $gestPreJur->descripcion_gestion = $model->prejur_gestion_prejuridica;
                        $gestPreJur->save();
                    } else {
                        $gestPreJur = new \app\models\GestionesPrejuridicas();
                        $gestPreJur->proceso_id = $model->id;
                        $gestPreJur->fecha_gestion = date('Y-m-d H:i:s');
                        $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                        $gestPreJur->descripcion_gestion = $model->prejur_gestion_prejuridica;
                        $gestPreJur->save();
                    }

                    //OBTENGO TODA LA INFORMACION DE NUEVO PARA MOSTRAR LA NUEVA GESTION
                    $model = $this->findModel($id);
                    //GESTIONES PRE JURIDICAS PARA MOSTRAR 
                    $model->prejur_gestiones_prejuridicas = $model->gestionesPrejuridicas;
                }
                return $this->renderAjax('view-summary-prejuridico', [
                            'model' => $model
                ]);
            } else {
                return $this->renderAjax('view-summary-prejuridico', [
                            'model' => $model
                ]);
            }
            Yii::$app->end();
        }

        return $this->renderPartial('view-summary-prejuridico', [
                    'model' => $model
        ]);
    }

    public function actionViewSummaryJuridico($id) {
        $model = $this->findModel($id);
        //GESTIONES JURIDICAS PARA MOSTRAR 
        $model->jur_gestiones_juridicas = $model->gestionesJuridicas;

        if (Yii::$app->getRequest()->isAjax) {

            if ($model->load(Yii::$app->request->post())) {

                if (!empty($model->jur_gestion_juridica)) {

                    if (isset($_POST["CommentEditId"])) {
                        $gestPreJur = \app\models\GestionesJuridicas::findOne($_POST["CommentEditId"]);
                        $gestPreJur->descripcion_gestion = $model->jur_gestion_juridica;
                        $gestPreJur->save();
                    } else {
                        $gestPreJur = new \app\models\GestionesJuridicas();
                        $gestPreJur->proceso_id = $model->id;
                        $gestPreJur->fecha_gestion = !empty($model->jur_fecha_gestion_juridica) ? $model->jur_fecha_gestion_juridica : date('Y-m-d H:i:s');
                        $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                        $gestPreJur->descripcion_gestion = $model->jur_gestion_juridica;
                        $gestPreJur->save();
                    }

                    //OBTENGO TODA LA INFORMACION DE NUEVO PARA MOSTRAR LA NUEVA GESTION
                    $model = $this->findModel($id);
                    //GESTIONES PRE JURIDICAS PARA MOSTRAR 
                    $model->jur_gestiones_juridicas = $model->gestionesJuridicas;
                }
                return $this->renderAjax('view-summary-juridico', [
                            'model' => $model
                ]);
            } else {
                return $this->renderAjax('view-summary-juridico', [
                            'model' => $model
                ]);
            }
            Yii::$app->end();
        }

        return $this->renderPartial('view-summary-juridico', [
                    'model' => $model
        ]);
    }

    public function actionViewSummaryRadicado() {
        if (Yii::$app->getRequest()->isAjax) {
            return $this->renderAjax('view-summary-radicado', [
                        'depa' => $_POST['depa'],
                        'ciu' => $_POST['ciu'],
                        'juz' => $_POST['juz'],
                        'ano' => $_POST['ano'],
                        'con' => $_POST['con'],
                        'ins' => $_POST['ins'],
                        'comment' => $_POST['coment'],
                        'radicado' => $_POST['radicado'],
            ]);
        }
        Yii::$app->end();
    }

    public function actionCambiarEtapaPopup($id) {
        $model = $this->findModel($id);
        if (Yii::$app->getRequest()->isAjax) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //GESTIONES PRE JURIDICAS PARA MOSTRAR 
                $model->jur_gestiones_juridicas = $model->gestionesJuridicas;
                return $this->renderAjax('view-summary-juridico', [
                            'model' => $model
                ]);
            } else {
                return $this->renderAjax('view-summary-juridico', [
                            'model' => $model
                ]);
            }
            Yii::$app->end();
        }
        return $this->renderPartial('view-summary-juridico', [
                    'model' => $model
        ]);
    }

    /**
     * Deletes an existing Procesos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        //BORRADO LOGICO
        $model = $this->findModel($id);
        $model->delete = '1';
        $model->deleted = new \yii\db\Expression('NOW()');
        $model->deleted_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '';
        $model->save();

        //LOG
        $mensaje = "El registro #{$id} ha sido eliminado.";
        \Yii::info($mensaje, "cartera");

        return $this->redirect(['index']);
    }

    public function actionGestionPreJuridica() {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = \app\models\GestionesPrejuridicas::findOne($id);
        return \yii\helpers\Json::encode([
                    'id' => $model->id,
                    'fecha_gestion' => $model->fecha_gestion,
                    'usuario_gestion' => $model->usuario_gestion,
                    'descripcion_gestion' => $model->descripcion_gestion
        ]);
    }

    public function actionGestionJuridica() {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = \app\models\GestionesJuridicas::findOne($id);
        return \yii\helpers\Json::encode([
                    'id' => $model->id,
                    'fecha_gestion' => $model->fecha_gestion,
                    'usuario_gestion' => $model->usuario_gestion,
                    'descripcion_gestion' => $model->descripcion_gestion
        ]);
    }

    public function actionVistaPreviaNotificacion($id, $tipo = 'vista') {
        $model = $this->findModel($id);
        return $this->render('vista-previa-notificacion', ["model" => $model, "tipo" => $tipo]);
    }


    /**
     * Finds the Procesos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Procesos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Procesos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
