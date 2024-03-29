<?php

namespace app\controllers;

use Yii;
use app\models\Liquidaciones;
use app\models\LiquidacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LiquidacionesController implements the CRUD actions for Liquidaciones model.
 */
class LiquidacionesController extends Controller {

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
     * Lists all Liquidaciones models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LiquidacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Liquidaciones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Liquidaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Liquidaciones();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $model->estado_cuenta = UploadedFile::getInstance($model, 'estado_cuenta');
            try {
                $spreadSheetAry = $this->loadFile($model);

                // SI LOGRO LEER EL EXCEL LO GUARDO
                if (is_array($spreadSheetAry) && !empty($spreadSheetAry)) {
                    $fileName = str_replace(" ", "-", $model->estado_cuenta->baseName);
                    $fileName = "EstadoCuenta" . date('ymdhis') . '.' . strtolower($model->estado_cuenta->extension);
                    $model->estado_cuenta->saveAs('liquidaciones/' . $fileName);
                    $model->estado_cuenta = $fileName;
                    $model->datos = json_encode($spreadSheetAry);
                    if (!$model->save()) {
                        return $this->returnPlantillaError($model);
                    }
                } else {
                    return $this->returnPlantillaError($model);
                }
            } catch (Exception $exc) {
                return $this->returnPlantillaError($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function returnPlantillaError($model) {
        $model->cliente_id = "";
        $model->deudor_id = "";
        $model->addError('estado_cuenta', 'Error cargando la plantilla de Estado de cuenta. Por favor revisela e inténtelo de nuevo.');
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Liquidaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        # Plantilla actual
        $beforeEstadoCuenta = $model->estado_cuenta;

        if ($model->load(Yii::$app->request->post())) {

            $model->estado_cuenta = UploadedFile::getInstance($model, 'estado_cuenta');
            if (!is_null($model->estado_cuenta)) {
                try {
                    $spreadSheetAry = $this->loadFile($model);

                    // SI LOGRO LEER EL EXCEL LO GUARDO
                    if (is_array($spreadSheetAry) && !empty($spreadSheetAry)) {
                        $fileName = str_replace(" ", "-", $model->estado_cuenta->baseName);
                        $fileName = "EstadoCuenta" . date('ymdhis') . '.' . strtolower($model->estado_cuenta->extension);
                        $model->estado_cuenta->saveAs('liquidaciones/' . $fileName);
                        $model->estado_cuenta = $fileName;
                        $model->datos = json_encode($spreadSheetAry);

                        //elimino la antigua
                        if (file_exists('liquidaciones/' . $beforeEstadoCuenta) && !empty($beforeEstadoCuenta)) {
                            unlink('liquidaciones/' . $beforeEstadoCuenta);
                        }
                    } else {
                        return $this->returnPlantillaError($model);
                    }
                } catch (Exception $exc) {
                    return $this->returnPlantillaError($model);
                }
            } else {
                $model->estado_cuenta = $beforeEstadoCuenta;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    private function loadFile($model) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($model->estado_cuenta->tempName);
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $data = $sheet->toArray();
        //ELIMINAR POSICIONES VACIAS
        $spreadSheetAry = array_map('array_filter', $data);
        $spreadSheetAry = array_filter($spreadSheetAry);
        return $spreadSheetAry;

        /* $file = \PHPExcel_IOFactory::identify($model->estado_cuenta->tempName);
          $objReader = \PHPExcel_IOFactory::createReader($file);
          $objPHPExcel = $objReader->load($model->estado_cuenta->tempName);
          $excelSheet = $objPHPExcel->getActiveSheet();
          return $excelSheet->toArray(); */
    }

    /**
     * Deletes an existing Liquidaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //BORRADO FISICO
        $model = $this->findModel($id);
        if (!empty($model->estado_cuenta) && file_exists('liquidaciones/' . $model->estado_cuenta)) {
            unlink('liquidaciones/' . $model->estado_cuenta);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionVistaPrevia($id, $tipo = 'vista') {
        $model = $this->findModel($id);
        return $this->render('vista-previa', ["model" => $model, "tipo" => $tipo]);
    }

    public function actionGenerar($id, $tipo = 'carta') {
        $model = $this->findModel($id);
        return $this->render('generar', ["model" => $model, "tipo" => $tipo]);
    }

    /**
     * Finds the Liquidaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Liquidaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Liquidaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
