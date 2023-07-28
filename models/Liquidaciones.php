<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "liquidaciones".
 *
 * @property int $id ID
 * @property int $cliente_id
 * @property int $deudor_id
 * @property string|null $datos Datos
 * @property string $estado_cuenta Estado de cuenta
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Clientes $cliente
 * @property Deudores $deudor
 */
class Liquidaciones extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'liquidaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cliente_id', 'deudor_id'], 'required'],
            [['estado_cuenta'], 'required', 'on' => 'create'],
            [['cliente_id', 'deudor_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['datos'], 'string', 'max' => 500],
            [['estado_cuenta', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
            [['estado_cuenta'], 'file',
                'extensions' => 'xls',
                'mimeTypes' => 'application/vnd.ms-excel, text/csv',
                'maxSize' => 153600 //150KB
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'deudor_id' => 'Deudor ID',
            'datos' => 'Datos',
            'estado_cuenta' => 'Estado Cuenta',
            'created' => 'Created',
            'created_by' => 'Created By',
            'modified' => 'Modified',
            'modified_by' => 'Modified By',
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

}
