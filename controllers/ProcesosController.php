<?php

namespace app\controllers;

use Yii;
use app\models\Procesos;
use app\models\ProcesosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ConsolidadoPagosJuridicos;

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

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'pagos' => $pagos,
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
        $modelPagos = [new ConsolidadoPagosJuridicos];



        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
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

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos
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
        $model->colaboradores = \app\models\ProcesosXColaboradores::find()
                ->select('user_id')
                ->where(['proceso_id' => $id])
                ->column();

        //BIENES ACTUALES PARA MOSTRAR EN LA EDICION
        $model->prejur_estudio_bienes = \app\models\BienesXProceso::find()
                ->select('bien_id')
                ->where(['proceso_id' => $id])
                ->column();
        $model->prejur_estudio_bienes = $model->bienesXProcesos;

        //COMENTARIO BIENES ACTUALES PARA MOSTRAR EN LA EDICION
        $model->prejur_comentarios_estudio_bienes = \app\models\BienesXProceso::find()
                ->select('comentario')
                ->where(['proceso_id' => $id])
                ->indexBy('bien_id')
                ->column();

        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->prejur_gestiones_prejuridicas = $model->gestionesPrejuridicas;

        //DOCUMENTOS DE ACTIVACION ACTUALES PARA MOSTRAR EN LA EDICION
        $model->jur_documentos_activacion = \app\models\DocactivacionXProceso::find()
                ->select('documento_activacion_id')
                ->where(['proceso_id' => $id])
                ->column();

        //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR EN LA EDICION
        $modelPagos = $model->consolidadoPagosJuridicos;

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
            if ($model->save()) {

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS COLABORADORES ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->colaboradores)) {
                    \app\models\ProcesosXColaboradores::deleteAll(['proceso_id' => $model->id]);
                    foreach ($model->colaboradores as $colaborador) {
                        $proXcol = new \app\models\ProcesosXColaboradores();
                        $proXcol->proceso_id = $model->id;
                        $proXcol->user_id = $colaborador;
                        $proXcol->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS BIENES ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->prejur_estudio_bienes)) {
                    \app\models\BienesXProceso::deleteAll(['proceso_id' => $model->id]);
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

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS DOCUMENTOS DE ACTIVACION ACTUALES Y 
                // VOLVERLOS A CREAR
                if (!empty($model->jur_documentos_activacion)) {
                    \app\models\DocactivacionXProceso::deleteAll(['proceso_id' => $model->id]);
                    foreach ($model->jur_documentos_activacion as $doc) {
                        $docXpro = new \app\models\DocactivacionXProceso();
                        $docXpro->proceso_id = $model->id;
                        $docXpro->documento_activacion_id = $doc;
                        $docXpro->save();
                    }
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COONSOLIDADOS DE PAGO
                ConsolidadoPagosJuridicos::deleteAll(['proceso_id' => $model->id]);
                if (isset($_POST['ConsolidadoPagosJuridicos'])) {
                    foreach ($_POST['ConsolidadoPagosJuridicos'] as $pago) {
                        $mdlPagos = new ConsolidadoPagosJuridicos();
                        $mdlPagos->valor_pago = $pago['valor_pago'];
                        $mdlPagos->fecha_pago = $pago['fecha_pago'];
                        $mdlPagos->proceso_id = $model->id;
                        $mdlPagos->save();
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
                        'modelPagos' => (empty($modelPagos)) ? [new ConsolidadoPagosJuridicos] : $modelPagos
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
        $this->findModel($id)->delete();

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
