<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jurisdicciones_competentes".
 *
 * @property int $id ID
 * @property int $ciudad_id Ciudad
 * @property string $entidad Entidad
 * @property int $codigo_entidad Código de entidad
 * @property string $especialidad Especialidad
 * @property int $codigo_especialidad Código de especialidad
 * @property int $despacho Despacho
 * @property string $nombre Nombre
 * @property string $email Correo electrónico
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property int|null $delete Borrado
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
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
            [['ciudad_id', 'entidad', 'codigo_entidad', 'especialidad', 'codigo_especialidad', 'despacho', 'nombre','email'], 'required'],
            [['ciudad_id', 'codigo_entidad', 'codigo_especialidad', 'despacho', 'delete'], 'integer'],
            [['email'], 'email'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['entidad', 'especialidad', 'created_by', 'modified_by', 'deleted_by','email'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 100],
            [['nombre', 'entidad', 'especialidad','email'], 'filter', 'filter' => 'strtoupper'],
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
            'entidad' => 'Entidad',
            'codigo_entidad' => 'Código de entidad',
            'especialidad' => 'Especialidad',
            'codigo_especialidad' => 'Código de especialidad',
            'despacho' => 'Despacho',
            'nombre' => 'Nombre',
            'email' => 'Correo electrónico',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'delete' => 'Borrado',
            'deleted' => 'Borrado',
            'deleted_by' => 'Borrado por',
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
