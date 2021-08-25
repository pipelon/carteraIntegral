<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name Nombres y Apellidos
 * @property string $username Nombre de usuario
 * @property string $password Contraseña
 * @property string $mail Correo Electrónico
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por

 * @property Procesos[] $proceso
 * @property ProcesosXColaboradores[] $procesosXColaboradores
 * @property Tareas[] $tareas
 */
class Users extends BeforeModel {

    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'username', 'mail'], 'required'],
            [['password', 'password_repeat'], 'required', 'on' => ['create']],
            [['active'], 'integer'],
            ['mail', 'email'],
            [['username', 'mail'], 'unique'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '=='],
            ['username', 'match', 'not' => true, 'pattern' => '/[^a-z0-9._-]/',
                'on' => ['create', 'update'],
                'message' => 'No se permiten espacios o caracteres especiales'],
            [['created', 'modified'], 'safe'],
            [['name', 'password'], 'string', 'max' => 100],
            [['username', 'mail'], 'string', 'max' => 45],
            [['created_by', 'modified_by'], 'string', 'max' => 150],
            [['name', 'mail'], 'filter', 'filter' => 'strtoupper'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'username' => 'Usuario',
            'password' => 'Clave',
            'password_repeat' => 'Repetir clave',
            'mail' => 'Correo',
            'active' => 'Activo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    public static function findIdentity($id) {
        return Users::findOne($id);
    }
    
    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jefe_id' => 'id']);
    }

    /**
     * Gets query for [[ProcesosXColaboradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesosXColaboradores() {
        return $this->hasMany(ProcesosXColaboradores::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tareas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTareas() {
        return $this->hasMany(Tareas::className(), ['user_id' => 'id']);
    }

}
