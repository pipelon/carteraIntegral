<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados_proceso".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property int $activo Activo
 * @property int|null $delete Borrado
 * @property string $created Creado
 * @property string|null $created_by Creado por
 * @property string $modified Modificado
 * @property string|null $modified_by Modificado por
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
 *
 * @property Procesos[] $procesos
 */
class EstadosProceso extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'estados_proceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre', 'activo'], 'required'],
            [['activo', 'delete'], 'integer'],
            [['created', 'modified'], 'safe'],
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
            'delete' => 'Delete',
            'created' => 'Created',
            'created_by' => 'Created By',
            'modified' => 'Modified',
            'modified_by' => 'Modified By',
            'deleted' => 'Deleted',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['estado_proceso_id' => 'id']);
    }

}
