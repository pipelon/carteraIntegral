<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso
 * @property int $user_id Asignada a
 * @property int $jefe_id Jefe del proceso
 * @property string $fecha_esperada
 * @property string|null $fecha_finalizacion Fecha finalización de la tarea
 * @property string $descripcion Descripción
 * @property int $estado Estado
 *
 * @property Procesos $proceso
 * @property Users $user
 * @property Users $jefe
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
            [['proceso_id', 'user_id', 'jefe_id', 'fecha_esperada', 'descripcion'], 'required'],
            [['proceso_id', 'user_id', 'jefe_id', 'estado'], 'integer'],
            [['fecha_esperada', 'fecha_finalizacion'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion', 'filter', 'filter' => 'strtoupper'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['jefe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['jefe_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso',
            'user_id' => 'Asignada a',
            'jefe_id' => 'Jefe del proceso',
            'fecha_esperada' => 'Fecha Esperada',
            'fecha_finalizacion' => 'Fecha finalización de la tarea',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
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

    /**
     * Gets query for [[Jefe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJefe() {
        return $this->hasOne(Users::className(), ['id' => 'jefe_id']);
    }

}
