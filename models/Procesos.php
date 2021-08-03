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
 * @property string|null $prejur_concepto_viabilidad Concepto  viabilidad
 * @property string|null $prejur_otros Otros
 * @property string|null $jur_fecha_recepcion Fecha activación
 * @property float|null $jur_valor_activacion Valor activación
 * @property float|null $jur_saldo_actual Saldo actual
 * @property int|null $jur_tipo_proceso_id Tipo de proceso
 * @property int|null $jur_etapas_procesal_id Etapa procesal
 * @property string|null $carpeta
 *
 * @property BienesXProceso[] $bienesXProcesos
 * @property ConsolidadoPagosJuridicos[] $consolidadoPagosJuridicos
 * @property DocactivacionXProceso[] $docactivacionXProcesos
 * @property GestionesPrejuridicas[] $gestionesPrejuridicas
 * @property Clientes $cliente
 * @property Deudores $deudor
 * @property EtapasProcesales $jurEtapasProcesal
 * @property TipoCasos $prejurTipoCaso
 * @property TipoProcesos $jurTipoProceso
 * @property ProcesosXColaboradores[] $procesosXColaboradores
 */
class Procesos extends \yii\db\ActiveRecord {
    
    public $colaboradores;
    public $prejur_estudio_bienes;
    public $prejur_comentarios_estudio_bienes;
    public $prejur_gestion_prejuridica;
    public $prejur_gestiones_prejuridicas;
    public $jur_documentos_activacion;

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
            [['cliente_id', 'deudor_id', 'prejur_tipo_caso', 'jur_tipo_proceso_id', 'jur_etapas_procesal_id'], 'integer'],
            [['prejur_fecha_recepcion', 'jur_fecha_recepcion', 'prejur_estudio_bienes',
            'prejur_comentarios_estudio_bienes', 'prejur_gestion_prejuridica',
            'prejur_gestiones_prejuridicas', 'jur_documentos_activacion'], 'safe'],
            [['carpeta'], 'string', 'max' => 100],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora', 'prejur_concepto_viabilidad', 'prejur_otros'], 'string'],
            [['jur_valor_activacion', 'jur_saldo_actual'], 'number'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
            [['jur_etapas_procesal_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesales::className(), 'targetAttribute' => ['jur_etapas_procesal_id' => 'id']],
            [['prejur_tipo_caso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCasos::className(), 'targetAttribute' => ['prejur_tipo_caso' => 'id']],
            [['jur_tipo_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProcesos::className(), 'targetAttribute' => ['jur_tipo_proceso_id' => 'id']],
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
            'jur_fecha_recepcion' => 'Fecha activación',
            'jur_valor_activacion' => 'Valor activación',
            'jur_saldo_actual' => 'Saldo actual',
            'jur_tipo_proceso_id' => 'Tipo de proceso',
            'jur_etapas_procesal_id' => 'Etapa procesal',
            'carpeta' => 'Carpeta Google Drive',
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
     * Gets query for [[ConsolidadoPagosJuridicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsolidadoPagosJuridicos() {
        return $this->hasMany(ConsolidadoPagosJuridicos::className(), ['proceso_id' => 'id']);
    }

    /**
     * Gets query for [[DocactivacionXProcesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocactivacionXProcesos() {
        return $this->hasMany(DocactivacionXProceso::className(), ['proceso_id' => 'id']);
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
     * Gets query for [[JurEtapasProcesal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurEtapasProcesal() {
        return $this->hasOne(EtapasProcesales::className(), ['id' => 'jur_etapas_procesal_id']);
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
     * Gets query for [[JurTipoProceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurTipoProceso() {
        return $this->hasOne(TipoProcesos::className(), ['id' => 'jur_tipo_proceso_id']);
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
