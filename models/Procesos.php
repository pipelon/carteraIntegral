<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos".
 *
 * @property int $id ID
 * @property int $cliente_id Demandante
 * @property int $deudor_id Demandado
 * @property int $jefe_id Líder
 * @property int|null $plataforma_id Plataforma							   
 * @property string|null $prejur_fecha_recepcion Fecha recepción
 * @property float|null $prejur_valor_activacion Valor de activación
 * @property float|null $prejur_saldo_actual Saldo actual
 * @property string|null $prejur_carta_enviada ¿Se envía carta?
 * @property string|null $prejur_fecha_carta Comentarios
 * @property string|null $prejur_llamada_realizada ¿Se realiza llamada telefónica?
 * @property string|null $prejur_fecha_llamada Comentarios
 * @property string|null $prejur_visita_domiciliaria ¿Se realiza visita domiciliaria?
 * @property string|null $prejur_fecha_visita Comentarios							   
 * @property string|null $prejur_acuerdo_pago ¿Hay acuerdo de pago?																	
 * @property string|null $prejur_fecha_no_acuerdo_pago Fecha de marcación de que no hubo acuerdo de pago
 * @property string $prejur_resultado_estudio_bienes Resultado del estudio de bienes
 * @property string|null $prejur_fecha_estudio_bienes Fecha de certificación del resultado del estudio de bienes
 * @property string|null $prejur_informe_castigo_enviado ¿Se envía informe de inviabilidad o castigo?
 * @property string|null $prejur_carta_castigo_enviada ¿Se envía carta de inviabilidad o castigo?
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
 * @property string|null jur_jurisdiccion_competent_caso_especial_id
 * @property string|null $jur_juzgado Juzgado
 * @property string|null $jur_anio_radicado Juzgado
 * @property string|null $jur_consecutivo_proceso Juzgado
 * @property string|null $jur_instancia_radicado Juzgado
 * @property string|null $jur_radicado Radicado			 
 * @property int|null $jur_departamento_id_2 Departamento
 * @property int|null $jur_ciudad_id_2 Ciudad
 * @property int|null $jur_jurisdiccion_competent_id_2 Jurisdicción competente
 * @property string|null jur_jurisdiccion_competent_caso_especial_id_2
 * @property string|null $jur_juzgado_2 Juzgado
 * @property string|null $jur_anio_radicado_2 Juzgado
 * @property string|null $jur_consecutivo_proces_2o Juzgado
 * @property string|null $jur_instancia_radicado_2 Juzgado
 * @property string|null $jur_radicado_2 Radicado			 
 * @property int|null $jur_departamento_id_3 Departamento
 * @property int|null $jur_ciudad_id_3 Ciudad
 * @property int|null $jur_jurisdiccion_competent_id_3 Jurisdicción competente
 * @property string|null jur_jurisdiccion_competent_caso_especial_id_3
 * @property string|null $jur_juzgado_3 Juzgado
 * @property string|null $jur_anio_radicado_3 Juzgado
 * @property string|null $jur_consecutivo_proceso_3 Juzgado
 * @property string|null $jur_instancia_radicado_3 Juzgado
 * @property string|null $jur_radicado_3 Radicado			 
 * @property int|null $jur_tipo_proceso_id Tipo de proceso
 * @property int|null $jur_etapas_procesal_id Etapa procesal
 * @property string|null $jur_fecha_etapa_procesal Fecha Etapa procesal
 * @property string|null $carpeta Carpeta Google Drive
 * @property string|null $estrec_pretenciones Pretenciones
 * @property string|null $estrec_probabilidad_recuperacion Probabilidad de recuperación
 * @property string|null $estrec_tiempo_recuperacion Tiempo estimado de recuperación
 * @property string|null $estrec_comentarios Comentarios
 * @property int $estado_proceso_id Estado del proceso
 * @property int|null $delete Borrado
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por		
 * @property string|null $file Archivos cargados											
 * 							   
 * @property Alertas[] $alertas
 * @property BienesXProceso[] $bienesXProcesos
 * @property ConsolidadoPagosJuridicos[] $consolidadoPagosJuridicos
 * @property ValoresActivacionJuridico[] ValoresActivacionJuridico
 * @property ConsolidadoPagosPrejuridicos[] $consolidadoPagosPrejuridicos																		 
 * @property DocactivacionXProceso[] $docactivacionXProcesos
 * @property GestionesPrejuridicas[] $gestionesPrejuridicas
 * @property Ciudades $jurCiudad
 * @property Clientes $cliente
 * @property Departamentos $jurDepartamento
 * @property Deudores $deudor
 * @property EstadosProceso $estadoProceso
 * @property EtapasProcesales $jurEtapasProcesal
 * @property JurisdiccionesCompetentes $jurJurisdiccionCompetent
 * @property Plataformas $plataforma
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
    public $jur_gestion_juridica;
    public $jur_gestiones_juridicas;
    public $jur_demandados;
    public $jur_fecha_gestion_juridica;
    public $file;

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
            [['cliente_id', 'deudor_id', 'jefe_id',
            'estado_proceso_id', 'prejur_fecha_recepcion', 'prejur_tipo_caso',
            'prejur_valor_activacion', 'prejur_saldo_actual', 'prejur_acuerdo_pago',
            'prejur_estudio_bienes', 'prejur_informe_castigo_enviado', 'prejur_carta_castigo_enviada',
            'prejur_consulta_rama_judicial',
            'prejur_consulta_entidad_reguladora', 'prejur_resultado_estudio_bienes',
            'prejur_carta_enviada', 'prejur_llamada_realizada', 'prejur_visita_domiciliaria',
            'carpeta'], 'required'],
            [['cliente_id', 'deudor_id', 'jefe_id', 'prejur_tipo_caso',
            'jur_tipo_proceso_id', 'jur_etapas_procesal_id',
            'estado_proceso_id', 'jur_departamento_id', 'jur_ciudad_id',
            'jur_jurisdiccion_competent_id', 'jur_departamento_id_2', 'jur_ciudad_id_2',
            'jur_jurisdiccion_competent_id_2', 'jur_departamento_id_3', 'jur_ciudad_id_3',
            'jur_jurisdiccion_competent_id_3'], 'integer'],
            [['prejur_fecha_recepcion', 'prejur_fecha_no_acuerdo_pago',
            'jur_fecha_recepcion', 'prejur_resultado_estudio_bienes',
            'prejur_fecha_estudio_bienes', 'prejur_comentarios_estudio_bienes', 'prejur_gestion_prejuridica',
            'prejur_gestiones_prejuridicas', 'jur_documentos_activacion',
            'colaboradores', 'deleted', 'jur_gestion_juridica', 'jur_gestiones_juridicas',
            'jur_demandados', 'jur_fecha_etapa_procesal', 'prejur_fecha_carta',
            'prejur_fecha_llamada', 'prejur_fecha_visita', 'jur_comentario_radicado_1',
            'jur_comentario_radicado_2', 'jur_comentario_radicado_3',
            'jur_fecha_gestion_juridica', 'prejur_estudio_bienes', 'modified', 'file'], 'safe'],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora',
            'prejur_concepto_viabilidad', 'prejur_otros', 'estrec_pretenciones',
            'estrec_tiempo_recuperacion', 'estrec_comentarios'], 'string'],
            [['prejur_valor_activacion', 'prejur_saldo_actual',
            'jur_valor_activacion', 'jur_saldo_actual'], 'number'],
            [['prejur_carta_enviada', 'prejur_llamada_realizada',
            'prejur_visita_domiciliaria', 'prejur_acuerdo_pago',
            'prejur_informe_castigo_enviado', 'prejur_carta_castigo_enviada'], 'string', 'max' => 3],
            [['jur_juzgado'], 'string', 'max' => 200],
            [['jur_juzgado_2'], 'string', 'max' => 200],
            [['jur_juzgado_3'], 'string', 'max' => 200],
            [['jur_jurisdiccion_competent_caso_especial_id',
            'jur_jurisdiccion_competent_caso_especial_id_2',
            'jur_jurisdiccion_competent_caso_especial_id_3'], 'string', 'max' => 255],
            [['prejur_resultado_estudio_bienes'], 'string', 'max' => 12],
            [['carpeta'], 'string', 'max' => 100],
            [['estrec_probabilidad_recuperacion'], 'string', 'max' => 5],
            [['jur_consecutivo_proceso', 'jur_consecutivo_proceso_2', 'jur_consecutivo_proceso_3'], 'string', 'max' => 5, 'min' => 5],
            [['jur_anio_radicado', 'jur_anio_radicado_2', 'jur_anio_radicado_3'], 'string', 'max' => 5],
            [['jur_instancia_radicado', 'jur_instancia_radicado_2', 'jur_instancia_radicado_3'], 'string', 'max' => 2],
            [['deleted_by', 'jur_radicado', 'jur_radicado_2', 'jur_radicado_3'], 'string', 'max' => 45],
            [['jur_ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['jur_ciudad_id' => 'id']],
            [['jur_ciudad_id_2'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['jur_ciudad_id_2' => 'id']],
            [['jur_ciudad_id_3'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['jur_ciudad_id_3' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['jur_departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['jur_departamento_id' => 'id']],
            [['jur_departamento_id_2'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['jur_departamento_id_2' => 'id']],
            [['jur_departamento_id_3'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['jur_departamento_id_3' => 'id']],
            [['deudor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deudores::className(), 'targetAttribute' => ['deudor_id' => 'id']],
            [['estado_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosProceso::className(), 'targetAttribute' => ['estado_proceso_id' => 'id']],
            [['jur_etapas_procesal_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesales::className(), 'targetAttribute' => ['jur_etapas_procesal_id' => 'id']],
            [['jur_jurisdiccion_competent_id'], 'exist', 'skipOnError' => true, 'targetClass' => JurisdiccionesCompetentes::className(), 'targetAttribute' => ['jur_jurisdiccion_competent_id' => 'id']],
            [['plataforma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plataformas::className(), 'targetAttribute' => ['plataforma_id' => 'id']],
            [['prejur_tipo_caso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCasos::className(), 'targetAttribute' => ['prejur_tipo_caso' => 'id']],
            [['jur_tipo_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProcesos::className(), 'targetAttribute' => ['jur_tipo_proceso_id' => 'id']],
            [['jefe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['jefe_id' => 'id']],
            [['prejur_consulta_rama_judicial', 'prejur_consulta_entidad_reguladora',
            'prejur_concepto_viabilidad', 'prejur_otros', 'estrec_pretenciones',
            'estrec_tiempo_recuperacion', 'estrec_comentarios'], 'filter', 'filter' => 'strtoupper'],
            [['file'], 'file', 'extensions' => 'pdf,doc,docx,xls,xlsx']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cliente_id' => 'Demandante',
            'deudor_id' => 'Demandado',
            'jefe_id' => 'Líder',
            'plataforma_id' => 'Plataforma',
            'prejur_fecha_recepcion' => 'Fecha recepción',
            'prejur_valor_activacion' => 'Valor de activación',
            'prejur_saldo_actual' => 'Saldo actual',
            'prejur_carta_enviada' => '¿Se envía carta?',
            'prejur_fecha_carta' => 'Fecha',
            'prejur_llamada_realizada' => '¿Se realiza llamada telefónica?',
            'prejur_fecha_llamada' => 'Fecha',
            'prejur_visita_domiciliaria' => '¿Se realiza visita domiciliaria?',
            'prejur_fecha_visita' => 'Fecha',
            'prejur_acuerdo_pago' => '¿Hay acuerdo de pago?',
            'prejur_fecha_no_acuerdo_pago' => 'Fecha de marcación de que no hubo acuerdo de pago',
            'prejur_resultado_estudio_bienes' => 'Resultado del estudio de bienes',
            'prejur_fecha_estudio_bienes' => 'Fecha de certificación del resultado del estudio de bienes',
            'prejur_informe_castigo_enviado' => '¿Se envía informe de inviabilidad o castigo?',
            'prejur_carta_castigo_enviada' => '¿Se envía carta de inviabilidad o castigo?',
            'prejur_tipo_caso' => 'Tipo de caso',
            'prejur_consulta_rama_judicial' => 'Consulta rama judicial',
            'prejur_consulta_entidad_reguladora' => 'Consulta entidad reguladora',
            'prejur_estudio_bienes' => 'Estudio de bienes',
            'prejur_concepto_viabilidad' => 'Concepto',
            'prejur_gestion_prejuridica' => 'Gestión pre jurídica',
            'prejur_gestiones_prejuridicas' => 'Gestiones pre-jurídicas',
            'jur_gestion_juridica' => 'Gestión jurídica',
            'prejur_otros' => 'Otros',
            'jur_fecha_recepcion' => 'Fecha activación',
            'jur_valor_activacion' => 'Valor activación',
            'jur_saldo_actual' => 'Saldo actual',
            'jur_departamento_id' => 'Departamento',
            'jur_ciudad_id' => 'Ciudad',
            'jur_jurisdiccion_competent_id' => 'Jurisdicción competente',
            'jur_jurisdiccion_competent_caso_especial_id' => 'Jurisdicción competente',
            'jur_juzgado' => 'Juzgado',
            'jur_anio_radicado' => 'Año',
            'jur_consecutivo_proceso' => 'Consecutivo proceso',
            'jur_instancia_radicado' => 'Instancia',
            'jur_radicado' => 'Radicado',
            'jur_comentario_radicado_1' => 'Comentarios',
            'jur_departamento_id_2' => 'Departamento',
            'jur_ciudad_id_2' => 'Ciudad',
            'jur_jurisdiccion_competent_id_2' => 'Jurisdicción competente',
            'jur_jurisdiccion_competent_caso_especial_id_2' => 'Jurisdicción competente',
            'jur_juzgado_2' => 'Juzgado',
            'jur_anio_radicado_2' => 'Año',
            'jur_consecutivo_proceso_2' => 'Consecutivo proceso',
            'jur_instancia_radicado_2' => 'Instancia',
            'jur_radicado_2' => 'Radicado',
            'jur_comentario_radicado_2' => 'Comentarios',
            'jur_departamento_id_3' => 'Departamento',
            'jur_ciudad_id_3' => 'Ciudad',
            'jur_jurisdiccion_competent_id_3' => 'Jurisdicción competente',
            'jur_jurisdiccion_competent_caso_especial_id_3' => 'Jurisdicción competente',
            'jur_juzgado_3' => 'Juzgado',
            'jur_anio_radicado_3' => 'Año',
            'jur_consecutivo_proceso_3' => 'Consecutivo proceso',
            'jur_instancia_radicado_3' => 'Instancia',
            'jur_radicado_3' => 'Radicado',
            'jur_comentario_radicado_3' => 'Comentarios',
            'jur_tipo_proceso_id' => 'Tipo de proceso',
            'jur_etapas_procesal_id' => 'Etapa procesal',
            'jur_fecha_etapa_procesal' => 'Fecha etapa procesal',
            'jur_documentos_activacion' => 'Documentos de activación',
            'jur_demandados' => 'Codeudores',
            'jur_gestiones_juridicas' => 'Gestiones jurídicas',
            'jur_fecha_gestion_juridica' => 'Fecha gestión',
            'carpeta' => 'Carpeta Google Drive',
            'estrec_pretenciones' => 'Pretensiones',
            'estrec_probabilidad_recuperacion' => 'Probabilidad de recuperación',
            'estrec_tiempo_recuperacion' => 'Tiempo estimado de recuperación',
            'estrec_comentarios' => 'Comentarios',
            'estado_proceso_id' => 'Estado del proceso',
            'modified' => 'Modificado',
            'delete' => 'Borrado',
            'deleted' => 'Borrado',
            'deleted_by' => 'Borrado por',
            'file' => 'Archivos creados'
        ];
    }

    public function behaviors() {

        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['modified'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    public static function find() {
        return parent::find()
                        ->onCondition(['and',
                            ['=', static::tableName() . '.delete', 0]
        ]);
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
     * Gets query for [[ValoresActivacionJuridico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValoresActivacionJuridico() {
        return $this->hasMany(ValoresActivacionJuridico::className(), ['proceso_id' => 'id']);
    }

    /**
     * Gets query for [[ConsolidadoPagosPrejuridicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsolidadoPagosPrejuridicos() {
        return $this->hasMany(ConsolidadoPagosPrejuridicos::className(), ['proceso_id' => 'id']);
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
     * Gets query for [[DemandadosXProceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDemandadosXProceso() {
        return $this->hasMany(DemandadosXProceso::className(), ['proceso_id' => 'id']);
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
     * Gets query for [[GestionesPrejuridicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestionesJuridicas() {
        return $this->hasMany(GestionesJuridicas::className(), ['proceso_id' => 'id'])->orderBy(['fecha_gestion' => SORT_DESC]);
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
     * Gets query for [[JurCiudad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurCiudad2() {
        return $this->hasOne(Ciudades::className(), ['id' => 'jur_ciudad_id_2']);
    }

    /**
     * Gets query for [[JurCiudad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurCiudad3() {
        return $this->hasOne(Ciudades::className(), ['id' => 'jur_ciudad_id_3']);
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
     * Gets query for [[JurDepartamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurDepartamento2() {
        return $this->hasOne(Departamentos::className(), ['id' => 'jur_departamento_id_2']);
    }

    /**
     * Gets query for [[JurDepartamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurDepartamento3() {
        return $this->hasOne(Departamentos::className(), ['id' => 'jur_departamento_id_3']);
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
     * Gets query for [[JurJurisdiccionCompetent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurJurisdiccionCompetent2() {
        return $this->hasOne(JurisdiccionesCompetentes::className(), ['id' => 'jur_jurisdiccion_competent_id_2']);
    }

    /**
     * Gets query for [[JurJurisdiccionCompetent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurJurisdiccionCompetent3() {
        return $this->hasOne(JurisdiccionesCompetentes::className(), ['id' => 'jur_jurisdiccion_competent_id_3']);
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
