<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jurisdicciones_competentes".
 *
 * @property int $id ID
 * @property int $ciudad_id Ciudad
 * @property int|null $numero Número
 * @property string $nombre Nombre
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Ciudades $ciudad
 * @property Procesos[] $procesos
 */
class JurisdiccionesCompetentes extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'jurisdicciones_competentes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['ciudad_id', 'nombre'], 'required'],
            [['ciudad_id', 'numero'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            ['nombre', 'filter', 'filter' => 'strtoupper'],
            [['ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['ciudad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ciudad_id' => 'Ciudad',
            'numero' => 'Número',
            'nombre' => 'Nombre',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Ciudad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad() {
        return $this->hasOne(Ciudades::className(), ['id' => 'ciudad_id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jur_jurisdiccion_competent_id' => 'id']);
    }

}
