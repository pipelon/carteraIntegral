<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestiones_prejuridicas".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso
 * @property string $fecha_gestion Fecha de gestión
 * @property string $usuario_gestion Usuario de gestión
 * @property string $descripcion_gestion Descripción gestión
 *
 * @property Procesos $proceso
 */
class GestionesPrejuridicas extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'gestiones_prejuridicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'fecha_gestion', 'usuario_gestion', 'descripcion_gestion'], 'required'],
            [['proceso_id'], 'integer'],
            [['fecha_gestion'], 'safe'],
            [['descripcion_gestion'], 'string'],
            [['usuario_gestion'], 'string', 'max' => 100],
            [['usuario_gestion', 'descripcion_gestion'], 'filter', 'filter' => 'strtoupper'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso',
            'fecha_gestion' => 'Fecha de gestión',
            'usuario_gestion' => 'Usuario de gestión',
            'descripcion_gestion' => 'Descripción gestión',
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

}
