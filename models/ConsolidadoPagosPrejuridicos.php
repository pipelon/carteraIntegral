<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consolidado_pagos_prejuridicos".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso ID
 * @property string $fecha_acuerdo_pago Fecha de pago
 * @property float $valor_acuerdo_pago Valor
 * @property string|null $fecha_pago_realizado Pago realizado
 * @property float|null $valor_pagado Valor pagado
 * @property string|null $descripcion Descripción
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modficiado por
 *
 * @property Procesos $proceso
 */
class ConsolidadoPagosPrejuridicos extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'consolidado_pagos_prejuridicos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'fecha_acuerdo_pago', 'valor_acuerdo_pago'], 'required'],
            [['proceso_id'], 'integer'],
            [['fecha_acuerdo_pago', 'fecha_pago_realizado', 'created', 'modified'], 'safe'],
            [['valor_acuerdo_pago', 'valor_pagado'], 'number'],
            [['descripcion'], 'string', 'max' => 400],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['descripcion'], 'filter', 'filter' => 'strtoupper'],
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
            'fecha_acuerdo_pago' => 'Fecha de pago',
            'valor_acuerdo_pago' => 'Valor',
            'fecha_pago_realizado' => 'Pago realizado',
            'valor_pagado' => 'Valor pagado',
            'descripcion' => 'Descripción',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modficiado por',
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
