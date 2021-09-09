<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos".
 *
 * @property int $id
 * @property int $cliente_id Cliente
 * @property int $deudor_id Deudor
 * @property int $jefe_id Jefe
							   
 * @property string|null $prejur_fecha_recepcion Fecha recepción
 * @property int|null $prejur_tipo_caso Tipo de caso
 * @property string|null $prejur_consulta_rama_judicial Consulta rama judicial
 * @property string|null $prejur_consulta_entidad_reguladora Consulta entidad reguladora
 * @property string|null $prejur_concepto_viabilidad Concepto  viabilidad
 * @property string|null $prejur_otros Otros
 * @property string|null $jur_fecha_recepcion Fecha activación
 * @property float|null $jur_valor_activacion Valor activación
 * @property float|null $jur_saldo_actual Saldo actual
 * @property int|null $jur_departamento_id Departamento
 * @property int|null $jur_ciudad_id Ciudad
 * @property int|null $jur_jurisdiccion_competent_id Jurisdicción competente
 * @property string|null $jur_juzgado Juzgado					 
 * @property int|null $jur_tipo_proceso_id Tipo de proceso
 * @property int|null $jur_etapas_procesal_id Etapa procesal
 * @property string|null $carpeta Carpeta Google Drive
 * @property string|null $estrec_pretenciones Estado de recuperación
 * @property string|null $estrec_probabilidad_recuperacion Probabilidad de recuperación
 * @property string|null $estrec_tiempo_recuperacion
 * @property string|null $estrec_comentarios
 * @property int $estado_proceso_id
 *
							   
 * @property BienesXProceso[] $bienesXProcesos
 * @property ConsolidadoPagosJuridicos[] $consolidadoPagosJuridicos
 * @property DocactivacionXProceso[] $docactivacionXProcesos
 * @property GestionesPrejuridicas[] $gestionesPrejuridicas
 * @property Ciudades $jurCiudad								
 * @property Clientes $cliente
 * @property Departamentos $jurDepartamento										   
 * @property Deudores $deudor
 * @property EstadosProceso $estadoProceso
 * @property EtapasProcesales $jurEtapasProcesal
 * @property JurisdiccionesCompetentes $jurJurisdiccionCompetent																
									
 * @property TipoCasos $prejurTipoCaso
 * @property TipoProcesos $jurTipoProceso
 * @property Users $jefe
 * @property ProcesosXColaboradores[] $procesosXColaboradores
 * @property Tareas[] $tareas

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
            [['cliente_id', 'deudor_id', 'jefe_id', 'estado_proceso_id', 'plataforma_id'], 'required'],
            [['cliente_id', 'deudor_id', 'jefe_id', 'prejur_tipo_caso',
            'jur_tipo_proceso_id', 'jur_etapas_procesal_id',
            'estado_proceso_id', 'jur_departamento_id', 'jur_ciudad_id',
            'jur_jurisdiccion_competent_id',], 'integer'],
            [['prejur_fecha_recepcion', 'jur_fecha_recepcion', 'prejur_estudio_bienes',
            'prejur_comentarios_estudio_bienes', 'prejur_gestion_prejuridica',
            'prejur_gestiones_prejuridicas', 'jur_documentos_activacion', 'colaboradores'], 'safe'],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora',
            'prejur_concepto_viabilidad', 'prejur_otros', 'estrec_pretenciones',
            'estrec_tiempo_recuperacion', 'estrec_comentarios'], 'string'],
            [['jur_valor_activacion', 'jur_saldo_actual'], 'number'],
            [['jur_juzgado'], 'string', 'max' => 200],
            [['carpeta'], 'string', 'max' => 100],
            [['estrec_probabilidad_recuperacion'], 'string', 'max' => 5],
            [['jur_ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['jur_ciudad_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['jur_departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['jur_departamento_id' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
            [['estado_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosProceso::className(), 'targetAttribute' => ['estado_proceso_id' => 'id']],
            [['jur_etapas_procesal_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesales::className(), 'targetAttribute' => ['jur_etapas_procesal_id' => 'id']],
            [['jur_jurisdiccion_competent_id'], 'exist', 'skipOnError' => true, 'targetClass' => JurisdiccionesCompetentes::className(), 'targetAttribute' => ['jur_jurisdiccion_competent_id' => 'id']],
																																						   
            [['prejur_tipo_caso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCasos::className(), 'targetAttribute' => ['prejur_tipo_caso' => 'id']],
            [['jur_tipo_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProcesos::className(), 'targetAttribute' => ['jur_tipo_proceso_id' => 'id']],
            [['jefe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['jefe_id' => 'id']],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora',
            'prejur_concepto_viabilidad', 'prejur_otros', 'estrec_pretenciones',
            'estrec_tiempo_recuperacion', 'estrec_comentarios'], 'filter', 'filter' => 'strtoupper']
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
            'jefe_id' => 'Líder',
            'plataforma_id' => 'Plataforma',					   
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
            'jur_departamento_id' => 'Departamento',
            'jur_ciudad_id' => 'Ciudad',
            'jur_jurisdiccion_competent_id' => 'Jurisdicción competente',
            'jur_juzgado' => 'Juzgado',
            'jur_tipo_proceso_id' => 'Tipo de proceso',
            'jur_etapas_procesal_id' => 'Etapa procesal',
            'jur_documentos_activacion' => 'Documentos de activación',
            'carpeta' => 'Carpeta Google Drive',
            'estrec_pretenciones' => 'Pretenciones',
            'estrec_probabilidad_recuperacion' => 'Probabilidad de recuperación',
            'estrec_tiempo_recuperacion' => 'Tiempo estimado de recuperación',
            'estrec_comentarios' => 'Comentarios',
            'estado_proceso_id' => 'Estado proceso',
        ];
    }
    
    /**
     * Gets query for [[Alertas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlertas() {
        return $this->hasMany(Alertas::className(), ['proceso_id' => 'id']);
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
        return $this->hasMany(GestionesPrejuridicas::className(), ['proceso_id' => 'id'])->orderBy(['fecha_gestion' => SORT_DESC]);
    }

    /**
     * Gets query for [[JurCiudad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurCiudad() {
        return $this->hasOne(Ciudades::className(), ['id' => 'jur_ciudad_id']);
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
     * Gets query for [[JurDepartamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurDepartamento() {
        return $this->hasOne(Departamentos::className(), ['id' => 'jur_departamento_id']);
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
     * Gets query for [[EstadoProceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoProceso() {
        return $this->hasOne(EstadosProceso::className(), ['id' => 'estado_proceso_id']);
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
     * Gets query for [[JurJurisdiccionCompetent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurJurisdiccionCompetent() {
        return $this->hasOne(JurisdiccionesCompetentes::className(), ['id' => 'jur_jurisdiccion_competent_id']);
    }

    /**
     * Gets query for [[Plataforma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlataforma() {
        return $this->hasOne(Plataformas::className(), ['id' => 'plataforma_id']);
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
     * Gets query for [[Jefe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJefe() {
        return $this->hasOne(Users::className(), ['id' => 'jefe_id']);
    }

    /**
     * Gets query for [[ProcesosXColaboradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesosXColaboradores() {
        return $this->hasMany(ProcesosXColaboradores::className(), ['proceso_id' => 'id']);
    }

    /**
     * Gets query for [[Tareas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTareas() {
        return $this->hasMany(Tareas::className(), ['proceso_id' => 'id']);
    }

}