<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bienes".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property int $activo Activo
 * @property int|null $delete Borrado
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
 *
 * @property BienesXProceso[] $bienesXProcesos
 */
class Bienes extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'bienes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre', 'activo'], 'required'],
            [['activo', 'delete'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['nombre', 'created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
            ['nombre', 'filter', 'filter' => 'strtoupper']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
            'delete' => 'Borrado',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'deleted' => 'Borrado',
            'deleted_by' => 'Borrado por',
        ];
    }

    /**
     * Gets query for [[BienesXProcesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBienesXProcesos() {
        return $this->hasMany(BienesXProceso::className(), ['bien_id' => 'id']);
    }

}
