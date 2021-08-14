<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consolidado_pagos_juridicos".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso
 * @property float $valor_pago Valor
 * @property string $fecha_pago Fecha de pago
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
            [['proceso_id', 'valor_pago', 'fecha_pago'], 'required'],
            [['proceso_id'], 'integer'],
            [['valor_pago'], 'number'],
            [['fecha_pago'], 'safe'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso ID',
            'valor_pago' => 'Valor Pago',
            'fecha_pago' => 'Fecha Pago',
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
