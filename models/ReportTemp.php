<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_temp".
 *
 * @property int $id
 * @property string|null $col1 Fecha entrega
 * @property string|null $col2 Patrimonio autónomo
 * @property string|null $col3 Deudor
 * @property string|null $col4 Marca
 * @property string|null $col5 Cédula o NIT
 * @property string|null $col6 Valor capital entregado
 * @property string|null $col7 Saldo actual
 * @property string|null $col8 Consolidado pagos
 * @property string|null $col9 Tipo de proceso
 * @property string|null $col10 Juzgado
 * @property string|null $col11 Ciudad
 * @property string|null $col12 Radicado
 * @property string|null $col13 Comentario jurídico
 * @property string|null $col14 Comentario Viabilidad
 * @property string|null $col15 Comentario PRE jurídico
 * @property string|null $col16 Probabilidad de recuperación
 * @property string|null $col17 Medidad cautelares - garantías
 */
class ReportTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['col1', 'col2', 'col3', 'col4', 'col5', 'col6', 'col7', 'col8', 'col9', 'col10', 'col11', 'col12', 'col13', 'col14', 'col15', 'col16', 'col17'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'col1' => 'Fecha entrega',
            'col2' => 'Patrimonio autónomo',
            'col17' => 'Deudor',
            'col3' => 'Marca',
            'col4' => 'Cédula o NIT',
            'col5' => 'Valor capital entregado',
            'col6' => 'Saldo actual',
            'col7' => 'Consolidado pagos',
            'col8' => 'Tipo de proceso',
            'col9' => 'Juzgado',
            'col10' => 'Ciudad',
            'col11' => 'Radicado',
            'col12' => 'Comentario jurídico',
            'col13' => 'Comentario Viabilidad',
            'col14' => 'Comentario PRE jurídico',
            'col15' => 'Probabilidad de recuperación',
            'col16' => 'Medidad cautelares - garantías',
        ];
    }
}
