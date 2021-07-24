<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos".
 *
 * @property int $id
 * @property int $cliente_id Cliente
 * @property int $deudor_id Deudor
 * @property string|null $prejur_fecha_recepcion Fecha recepción
 * @property int|null $prejur_tipo_caso Tipo de caso
 * @property string|null $prejur_consulta_rama_judicial Consulta rama judicial
 * @property string|null $prejur_consulta_entidad_reguladora Consulta entidad reguladora
 * @property string|null $prejur_estudio_bienes Estudio de bienes
 * @property string|null $prejur_concepto_viabilidad Concepto  viabilidad
 * @property string|null $prejur_otros Otros
 *
 * @property BienesXProceso[] $bienesXProcesos
 * @property GestionesPrejuridicas[] $gestionesPrejuridicas
 * @property Clientes $cliente
 * @property Deudores $deudor
 * @property TipoCasos $prejurTipoCaso
 * @property ProcesosXColaboradores[] $procesosXColaboradores
 */
class Procesos extends \yii\db\ActiveRecord {

    public $colaboradores;
    public $prejur_estudio_bienes;
    public $prejur_comentarios_estudio_bienes;
    public $prejur_gestion_prejuridica;
    public $prejur_gestiones_prejuridicas;

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
            [['cliente_id', 'deudor_id', 'prejur_tipo_caso'], 'integer'],
            [['prejur_fecha_recepcion', 'prejur_estudio_bienes',
            'prejur_comentarios_estudio_bienes', 'prejur_gestion_prejuridica',
            'prejur_gestiones_prejuridicas'], 'safe'],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora', 'prejur_concepto_viabilidad', 'prejur_otros'], 'string'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
            [['prejur_tipo_caso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCasos::className(), 'targetAttribute' => ['prejur_tipo_caso' => 'id']],
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
            'prejur_fecha_recepcion' => 'Fecha recepción',
            'prejur_tipo_caso' => 'Tipo de caso',
            'prejur_consulta_rama_judicial' => 'Consulta rama judicial',
            'prejur_consulta_entidad_reguladora' => 'Consulta entidad reguladora',
            'prejur_estudio_bienes' => 'Estudio de bienes',
            'prejur_concepto_viabilidad' => 'Concepto  viabilidad',
            'prejur_gestion_prejuridica' => 'Gestión pre jurídica',
            'prejur_otros' => 'Otros',
        ];
    }

    /**
     * Gets query for [[BienesXProcesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBienesXProcesos() {
        return $this->hasMany(BienesXProceso::className(), ['proceso_id' => 'id']);
    }

    /**
     * Gets query for [[GestionesPrejuridicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionesPrejuridicas() {
        return $this->hasMany(GestionesPrejuridicas::className(), ['proceso_id' => 'id']);
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
     * Gets query for [[PrejurTipoCaso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrejurTipoCaso() {
        return $this->hasOne(TipoCasos::className(), ['id' => 'prejur_tipo_caso']);
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
