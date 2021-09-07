<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dias_no_habiles".
 *
 * @property int $id
 * @property string $fecha_no_habil Fecha no hábil
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class DiasNoHabiles extends BeforeModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dias_no_habiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_no_habil'], 'required'],
            [['fecha_no_habil', 'created', 'modified'], 'safe'],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_no_habil' => 'Fecha no hábil',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }
}
