<?php

namespace app\controllers;

use Yii;
use app\models\Clientes;
use app\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller {

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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clientes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Clientes();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clientes model.
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
     * Obtiene el listado de clientes
     * @param type $search
     */
    public function actionGetclientes($search = null, $id = null) {
        $out = ['more' => false];

        if (!is_null($search)) {
            $data = Clientes::find()
                    ->select(['id' => 'id', 'text' => 'CONCAT(documento, " - ", nombre)'])
                    ->where('nombre LIKE "%' . $search . '%" ')
                    ->orWhere('documento LIKE "%' . $search . '%" ')
                    ->asArray()
                    ->all();
            $out['results'] = array_values($data);
        } elseif (!empty($id)) {
            $data = Clientes::find()
                    ->select(['id' => 'id', 'text' => 'CONCAT(documento, " - ", nombre)'])
                    ->where(['id' => $id])
                    ->asArray()
                    ->one();
            $out['results'] = $data;
        } else {
            $out['results'] = ['id' => 0, 'text' => 'No se encontró el cliente especificado'];
        }
        echo \yii\helpers\Json::encode($out);
    }

    /**
     * Deletes an existing Clientes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        // PRIMERO BSUCO SI EL DEUDOR ESTA SIENDO USADO EN UN PROCESO
        $procesos = \app\models\Procesos::find()
                ->where(['cliente_id' => $id])
                ->all();
        if (!empty($procesos)) {
            \Yii::$app->getSession()->setFlash('warning', 'Este cliente no puede ser eliminado ya que está siendo usando en 1 o más procesos');
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
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDigitoverificacion($id) {

        if (!$id || $id == "" || !is_numeric($id)) {
            return "SDV";
        }

        $dvArray = array_reverse(str_split($id));

        $dv = 0;
        $cuenta = count($dvArray);

        if ($cuenta > 15) {
            return "SDV";
        }

        //primer paso suma
        if ($cuenta > 0)
            $dv += $dvArray[0] * 3;
        if ($cuenta > 1)
            $dv += $dvArray[1] * 7;
        if ($cuenta > 2)
            $dv += $dvArray[2] * 13;
        if ($cuenta > 3)
            $dv += $dvArray[3] * 17;
        if ($cuenta > 4)
            $dv += $dvArray[4] * 19;
        if ($cuenta > 5)
            $dv += $dvArray[5] * 23;
        if ($cuenta > 6)
            $dv += $dvArray[6] * 29;
        if ($cuenta > 7)
            $dv += $dvArray[7] * 37;
        if ($cuenta > 8)
            $dv += $dvArray[8] * 41;
        if ($cuenta > 9)
            $dv += $dvArray[9] * 43;
        if ($cuenta > 10)
            $dv += $dvArray[10] * 47;
        if ($cuenta > 11)
            $dv += $dvArray[11] * 53;
        if ($cuenta > 12)
            $dv += $dvArray[12] * 59;
        if ($cuenta > 13)
            $dv += $dvArray[13] * 67;
        if ($cuenta > 14)
            $dv += $dvArray[14] * 61;


        //segundo paso modulo: 
        $dv = $dv % 11;
        //tercer paso redondeo
        $dv = round($dv);
        //cuarto paso validar si es 0 o 1, sino restarle el dv a 11
        if ($dv == 0 || $dv == 1) {
            return $dv;
        } else {
            return 11 - $dv;
        }
    }

}
