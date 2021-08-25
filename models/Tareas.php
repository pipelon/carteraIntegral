<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso
 * @property int $user_id Usuario
 * @property string $fecha_tarea Fecha
 * @property string $descripcion Descripción
 * @property int $estado Estado
 * @property string|null $fecha_finalizacion_tarea Fecha finalización de la tarea
 *
 * @property Procesos $proceso
 * @property Users $user
 */
class Tareas extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tareas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'user_id', 'fecha_tarea', 'descripcion'], 'required'],
            [['proceso_id', 'user_id', 'estado'], 'integer'],
            [['fecha_tarea', 'fecha_finalizacion_tarea'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion', 'filter', 'filter' => 'strtoupper'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso',
            'user_id' => 'Usuario',
            'fecha_tarea' => 'Fecha',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
            'fecha_finalizacion_tarea' => 'Fecha finalización de la tarea',
        ];
    }

    /**
     * Gets query for [[Proceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProceso() {
        return $this->hasOne(Procesos::className(), ['id' => 'proceso_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

}
