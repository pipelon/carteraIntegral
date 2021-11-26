<?php

namespace app\controllers;

use Yii;
use app\models\DocumentosActivacion;
use app\models\DocumentosActivacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentosActivacionController implements the CRUD actions for DocumentosActivacion model.
 */
class DocumentosActivacionController extends Controller {

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
     * Lists all DocumentosActivacion models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DocumentosActivacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentosActivacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DocumentosActivacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DocumentosActivacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //LOG
            $mensaje = "El documento de activacion '{$model->nombre}' ha sido creado.";
            \Yii::info($mensaje, "cartera");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DocumentosActivacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //LOG
            $mensaje = "El documento de activacion #'{$id}' ha sido editado.";
            \Yii::info($mensaje, "cartera");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DocumentosActivacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //BORRADO FISICO
        //$this->findModel($id)->delete();
        //BORRADO LOGICO
        $model = $this->findModel($id);
        $model->delete = '1';
        $model->deleted = new yii\db\Expression('NOW()');
        $model->deleted_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '';
        $model->save();

        //LOG
        $mensaje = "El documento de activacion '{$model->nombre}' ha sido creado.";
        \Yii::info($mensaje, "cartera");

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentosActivacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentosActivacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DocumentosActivacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
