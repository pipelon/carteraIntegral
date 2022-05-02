<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_alertas".
 *
 * @property int $tipo_alerta_id Identificador del tipo de alerta
 * @property int $dias_para_alerta Los días hábiles para alertar
 * @property string $asunto El asunto de la alerta
 * @property string $descripcion La descripción de la alerta
 * @property string $activa Estado del tipo de alerta
 * @property int|null $tipo_proceso_id_1 El tipo de proceso de la cual depende
 * @property int|null $depende_de_etapa_1 La etapa de la cual depende
 * @property int|null $tipo_proceso_id_2 El tipo de proceso de la cual depende
 * @property int|null $depende_de_etapa_2 La etapa de la cual depende
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property int|null $delete borrado
 * @property string|null $deleted borrado
 * @property string|null $deleted_by borrado por
 */
class TiposAlertas extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tipos_alertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['dias_para_alerta', 'asunto', 'descripcion', 'activa'], 'required'],
            [['dias_para_alerta', 'tipo_proceso_id_1', 'depende_de_etapa_1', 'tipo_proceso_id_2', 'depende_de_etapa_2', 'delete'], 'integer'],
            [['descripcion', 'activa'], 'string'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['asunto'], 'string', 'max' => 300],
            [['created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'tipo_alerta_id' => 'Identificador del tipo de alerta',
            'dias_para_alerta' => 'Los días hábiles para alertar',
            'asunto' => 'El asunto de la alerta',
            'descripcion' => 'La descripción de la alerta',
            'activa' => 'Estado del tipo de alerta',
            'tipo_proceso_id_1' => 'El tipo de proceso de la cual depende',
            'depende_de_etapa_1' => 'La etapa de la cual depende',
            'tipo_proceso_id_2' => 'El tipo de proceso de la cual depende',
            'depende_de_etapa_2' => 'La etapa de la cual depende',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'delete' => 'borrado',
            'deleted' => 'borrado',
            'deleted_by' => 'borrado por',
        ];
    }

    public function getEtapasProcesal() {
        return $this->hasOne(EtapasProcesales::className(), ['id' => 'depende_de_etapa_1']);
    }

    public function getEtapasProcesal2() {
        return $this->hasOne(EtapasProcesales::className(), ['id' => 'depende_de_etapa_2']);
    }

    public function getTipoProceso() {
        return $this->hasOne(TipoProcesos::className(), ['id' => 'tipo_proceso_id_1']);
    }

    public function getTipoProceso2() {
        return $this->hasOne(TipoProcesos::className(), ['id' => 'tipo_proceso_id_2']);
    }

}
