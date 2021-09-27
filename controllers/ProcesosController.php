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

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Procesos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->prejur_gestiones_prejuridicas = \app\models\GestionesPrejuridicas::find()
                ->where(['proceso_id' => $id])
                ->orderBy('fecha_gestion DESC')
                ->all();

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
        $pagos = $model->consolidadoPagosJuridicos;

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
        $acuerdoPagos = $model->consolidadoPagosPrejuridicos;

        //TAREAS ACTUALES PARA MOSTRAR
        $tareas = $model->tareas;

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'pagos' => $pagos,
                    'acuerdoPagos' => $acuerdoPagos,
                    'tareas' => $tareas,
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

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO PRINCIPAL DEL PROCESO
            if ($model->save()) {

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
                    if (!empty($model->prejur_gestion_prejuridica)) {
                        $gestPreJur = new \app\models\GestionesPrejuridicas();
                        $gestPreJur->proceso_id = $model->id;
                        $gestPreJur->fecha_gestion = date('Y-m-d H:i:s');
                        $gestPreJur->usuario_gestion = Yii::$app->user->identity->fullName ?? 'Anónimo';
                        $gestPreJur->descripcion_gestion = $model->prejur_gestion_prejuridica;
                        $gestPreJur->save();
                    }
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

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos,
                            'modelAcuerdoPagos' => (empty($modelAcuerdoPagos)) ? [new \app\models\ConsolidadoPagosPrejuridicos] : $modelAcuerdoPagos,
                            'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos,
                        'modelAcuerdoPagos' => (empty($modelAcuerdoPagos)) ? [new \app\models\ConsolidadoPagosPrejuridicos] : $modelAcuerdoPagos,
                        'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas
            ]);
        }
    }

    /**
     * Updates an existing Procesos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

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

        //DOCUMENTOS DE ACTIVACION ACTUALES PARA MOSTRAR EN LA EDICION        
        $model->jur_documentos_activacion = ArrayHelper::map(
                        $model->docactivacionXProcesos, 'documento_activacion_id', 'documento_activacion_id'
        );

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelPagos = $model->consolidadoPagosJuridicos;

        //ACUERDO DE PAGOS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelAcuerdoPagos = $model->consolidadoPagosPrejuridicos;

        //TAREAS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelTareas = $model->tareas;

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
            if ($model->save()) {

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
                            $mdlTareas->estado = $tarea['estado'] ?? '0';
                            $mdlTareas->save();
                        }
                    }
                }


                return $this->redirect(['view', 'id' => $model->id]);
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
                        'modelTareas' => (empty($modelTareas)) ? [new \app\models\Tareas] : $modelTareas
            ]);
        }
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

        return $this->redirect(['index']);
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
