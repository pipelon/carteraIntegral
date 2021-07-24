<?php

namespace app\controllers;

use Yii;
use app\models\Procesos;
use app\models\ProcesosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Procesos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Procesos();


        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
            if ($model->save()) {

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS COLABORADORES
                foreach ($model->colaboradores as $colaborador) {
                    $proXcol = new \app\models\ProcesosXColaboradores();
                    $proXcol->proceso_id = $model->id;
                    $proXcol->user_id = $colaborador;
                    $proXcol->save();
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO SE DEBEN GUARDAR LOS ESTUDIOS DE BIENES
                foreach ($model->prejur_estudio_bienes as $bien) {
                    $bieXpro = new \app\models\BienesXProceso();
                    $bieXpro->proceso_id = $model->id;
                    $bieXpro->bien_id = $bien;
                    $bieXpro->comentario = $model->prejur_comentarios_estudio_bienes[$bien];
                    $bieXpro->save();
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

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
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

        //COMENTARIO BIENES ACTUALES PARA MOSTRAR EN LA EDICION
        $model->prejur_comentarios_estudio_bienes = \app\models\BienesXProceso::find()
                ->select('comentario')
                ->where(['proceso_id' => $id])
                ->indexBy('bien_id')
                ->column();
        
        //GESTIONES PRE JURIDICAS PARA MOSTRAR 
        $model->prejur_gestiones_prejuridicas = \app\models\GestionesPrejuridicas::find()                
                ->where(['proceso_id' => $id])
                ->orderBy('fecha_gestion DESC')
                ->all();

        if ($model->load(Yii::$app->request->post())) {

            // SE GUARDA EL REGISTRO
            if ($model->save()) {

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS COLABORADORES ACTUALES Y 
                // VOLVERLOS A CREAR
                \app\models\ProcesosXColaboradores::deleteAll(['proceso_id' => $model->id]);
                foreach ($model->colaboradores as $colaborador) {
                    $proXcol = new \app\models\ProcesosXColaboradores();
                    $proXcol->proceso_id = $model->id;
                    $proXcol->user_id = $colaborador;
                    $proXcol->save();
                }

                // SI EL GUARDADO DEL PROCESO FUE EXITOSO 
                // SE DEBEN ELIMINARL LOS BIENES ACTUALES Y 
                // VOLVERLOS A CREAR
                \app\models\BienesXProceso::deleteAll(['proceso_id' => $model->id]);
                foreach ($model->prejur_estudio_bienes as $bien) {
                    $bieXpro = new \app\models\BienesXProceso();
                    $bieXpro->proceso_id = $model->id;
                    $bieXpro->bien_id = $bien;
                    $bieXpro->comentario = $model->prejur_comentarios_estudio_bienes[$bien];
                    $bieXpro->save();
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
                
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
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
