<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller {

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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        //VALIDO QUE SOLO PUEDA VERSE EL USUARIO PROPIO
        if ((!is_null($id) && $id != Yii::$app->user->identity->getId()) && !Yii::$app->user->identity->isSuperAdmin()) {
            throw new \yii\web\ForbiddenHttpException('No tienes permisos para acceder a este usuario.');
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Users();
        //Uso el escenaario create para requerir la clave y su repeat
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //codifico en md5 la clave
            $model->password = md5($model->password);
            $model->password_repeat = md5($model->password_repeat);
            if ($model->save()) {
                //LOG
                $mensaje = "El usuario '{$model->username}' ha sido creado.";
                \Yii::info($mensaje, "cartera");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
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
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        
        //VALIDO QUE SOLO PUEDA VERSE EL USUARIO PROPIO
        if ((!is_null($id) && $id != Yii::$app->user->identity->getId()) && !Yii::$app->user->identity->isSuperAdmin()) {
            throw new \yii\web\ForbiddenHttpException('No tienes permisos para acceder a este usuario.');
        }
        
        $model = $this->findModel($id);

        //clave y usuario anterior
        $beforeUser = $model->username;
        $beforePass = $model->password;
        $beforeImage = $model->profile_image;

        if ($model->load(Yii::$app->request->post())) {


            $model->profile_image = UploadedFile::getInstance($model, 'profile_image');
            if ($model->profile_image && $model->validate()) {
                $fileName = str_replace(" ", "-", $model->profile_image->baseName);
                $fileName = strtolower($fileName) . date('ymdhis') . '.' . strtolower($model->profile_image->extension);
                $model->profile_image->saveAs('perfiles/' . $fileName);
                $model->profile_image = $fileName;
                //elimino la antigua
                if (file_exists('perfiles/' . $beforeImage) && !empty($beforeImage)) {
                    unlink('perfiles/' . $beforeImage);
                }
            }

            // si no se cambio la foto entonces sigo con la antigua
            if (empty($model->profile_image)) {
                $model->profile_image = $beforeImage;
            }

            //valido si se cambiaron las claves
            if (empty($model->password)) {
                //conservo la clave anterior
                $model->password = $beforePass;
                $model->password_repeat = $beforePass;
            } else {
                //codifico en md5 la nueva clave
                $model->password = md5($model->password);
                $model->password_repeat = md5($model->password_repeat);
            }

            //guardo los cambios
            if ($model->save()) {

                //LOG
                $mensaje = "El usuario #'{$id}' ha sido actualizado.";
                \Yii::info($mensaje, "cartera");

                //valido si se cambio el propio usuario y de ser asi lo deslogueo        
                if ($beforeUser != $model->username && $id == Yii::$app->user->identity->getId()) {
                    Yii::$app->user->logout();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
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
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {

        $model = $this->findModel($id);

        $this->findModel($id)->delete();

        //LOG
        $mensaje = "El usuario '{$model->username}' ha sido eliminado.";
        \Yii::info($mensaje, "cartera");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
