<?php

namespace app\controllers;

use Yii;
use app\models\Bienes;
use app\models\BienesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BienesController implements the CRUD actions for Bienes model.
 */
class BienesController extends Controller {

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
     * Lists all Bienes models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BienesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bienes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bienes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Bienes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //LOG
            $mensaje = "El bien '{$model->nombre}' ha sido creado.";
            \Yii::info($mensaje, "cartera");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bienes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //LOG
            $mensaje = "El bien #'{$id}' ha sido editado.";
            \Yii::info($mensaje, "cartera");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bienes model.
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
        $mensaje = "El bien '{$model->nombre}' ha sido eliminado.";
        \Yii::info($mensaje, "cartera");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bienes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bienes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bienes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
