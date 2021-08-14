<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consolidado_pagos_juridicos".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso
 * @property float $valor Valor
 * @property string $fecha Fecha de pago
 *
 * @property Procesos $proceso
 */
class ConsolidadoPagosJuridicos extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'consolidado_pagos_juridicos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'valor', 'fecha'], 'required'],
            [['proceso_id'], 'integer'],
            [['valor'], 'number'],
            [['fecha'], 'safe'],
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
            'valor' => 'Valor',
            'fecha' => 'Fecha de pago',
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
