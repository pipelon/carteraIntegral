<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos".
 *
 * @property int $id
 * @property int $cliente_id Cliente
 * @property int $deudor_id
 *
 * @property Clientes $cliente
 * @property Deudores $deudor
 * @property ProcesosXColaboradores[] $procesosXColaboradores
 */
class Procesos extends \yii\db\ActiveRecord {

    public $colaboradores;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'procesos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cliente_id', 'deudor_id', 'colaboradores'], 'required'],
            [['cliente_id', 'deudor_id'], 'integer'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente',
            'deudor_id' => 'Deudor',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente() {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Deudor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeudor() {
        return $this->hasOne(Deudores::className(), ['id' => 'deudor_id']);
    }

    /**
     * Gets query for [[ProcesosXColaboradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesosXColaboradores() {
        return $this->hasMany(ProcesosXColaboradores::className(), ['proceso_id' => 'id']);
    }

}
