<?php

namespace app\controllers;

use Yii;
use app\models\Deudores;
use app\models\DeudoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeudoresController implements the CRUD actions for Deudores model.
 */
class DeudoresController extends Controller {

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
     * Lists all Deudores models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DeudoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deudores model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Deudores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Deudores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Deudores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Obtiene el listado de deudores
     * @param type $search
     */
    public function actionGetdeudores($search = null, $id = null) {
        $out = ['more' => false];

        if (!is_null($search)) {
            $data = Deudores::find()
                    ->select(['id' => 'id', 'text' => 'CONCAT(nombre, " - ", marca)'])
                    ->where('nombre LIKE "%' . $search . '%" ')
                    ->orWhere('marca LIKE "%' . $search . '%" ')
                    ->asArray()
                    ->all();
            $out['results'] = array_values($data);
        } elseif (!empty($id)) {
            $data = Deudores::find()
                    ->select(['id' => 'id', 'text' => 'CONCAT(nombre, " - ", marca)'])
                    ->where(['id' => $id])
                    ->asArray()
                    ->one();
            $out['results'] = $data;
        } else {
            $out['results'] = ['id' => 0, 'text' => 'No se encontró el deudor especificado'];
        }
        echo \yii\helpers\Json::encode($out);
    }

    /**
     * Deletes an existing Deudores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        // PRIMERO BSUCO SI EL DEUDOR ESTA SIENDO USADO EN UN PROCESO
        $procesos = \app\models\Procesos::find()
                ->where(['deudor_id' => $id])
                ->all();
        if (!empty($procesos)) {
            \Yii::$app->getSession()->setFlash('warning', 'Este deudor no puede ser eliminado ya que está siendo usando en 1 o más procesos');
            return $this->redirect(['index']);
        }

        //BORRADO LOGICO
        $model = $this->findModel($id);
        $model->delete = '1';
        $model->deleted = new yii\db\Expression('NOW()');
        $model->deleted_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '';
        $model->save();
        
        //LOG
        $mensaje = "El registro #{$id} ha sido eliminado.";
        \Yii::info($mensaje, "cartera");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deudores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deudores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Deudores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
