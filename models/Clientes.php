<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id ID
 * @property int|null $usuario_id Usuario
 * @property string $nombre Nombre
 * @property string $tipo_documento Tipo de documento
 * @property string $documento Documento
 * @property string $direccion Dirección física
 * @property string $nombre_representante_legal Nombres
 * @property string $telefono_representante_legal Teléfonos
 * @property string $email_representante_legal Correo electrónico
 * @property string $nombre_persona_contacto_1 Nombres
 * @property string $telefono_persona_contacto_1 Teléfonos
 * @property string $email_persona_contacto_1 Correo electrónico
 * @property string $cargo_persona_contacto_1 Cargo
 * @property string|null $nombre_persona_contacto_2 Nombres
 * @property string|null $telefono_persona_contacto_2 Teléfonos
 * @property string|null $email_persona_contacto_2 Correo electrónico
 * @property string|null $cargo_persona_contacto_2 Cargo
 * @property string|null $nombre_persona_contacto_3 Nombres
 * @property string|null $telefono_persona_contacto_3 Teléfonos
 * @property string|null $email_persona_contacto_3 Correo electrónico
 * @property string|null $cargo_persona_contacto_3 Cargo
 * @property string|null $carpeta Carpeta Google Drive
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property int|null $delete Borrado
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
 *
 * @property Users $usuario
 * @property Liquidaciones[] $liquidaciones
 * @property Procesos[] $procesos
 */
class Clientes extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['usuario_id', 'delete'], 'integer'],
            [['nombre', 'tipo_documento', 'documento', 'direccion', 'nombre_representante_legal', 'telefono_representante_legal', 'email_representante_legal', 'nombre_persona_contacto_1', 'telefono_persona_contacto_1', 'email_persona_contacto_1', 'cargo_persona_contacto_1'], 'required'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['nombre', 'nombre_representante_legal', 'telefono_representante_legal', 'email_representante_legal', 'nombre_persona_contacto_1', 'telefono_persona_contacto_1', 'email_persona_contacto_1', 'cargo_persona_contacto_1', 'nombre_persona_contacto_2', 'telefono_persona_contacto_2', 'email_persona_contacto_2', 'cargo_persona_contacto_2', 'nombre_persona_contacto_3', 'telefono_persona_contacto_3', 'email_persona_contacto_3', 'cargo_persona_contacto_3', 'created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
            [['tipo_documento'], 'string', 'max' => 30],
            [['documento'], 'string', 'max' => 20],
            [['direccion', 'carpeta'], 'string', 'max' => 100],
            [['tipo_documento', 'nombre', 'documento', 'direccion',
            'nombre_representante_legal', 'telefono_representante_legal',
            'email_representante_legal', 'nombre_persona_contacto_1',
            'telefono_persona_contacto_1', 'email_persona_contacto_1',
            'cargo_persona_contacto_1', 'cargo_persona_contacto_1',
            'nombre_persona_contacto_2', 'telefono_persona_contacto_2', 'email_persona_contacto_2',
            'cargo_persona_contacto_2', 'nombre_persona_contacto_3',
            'telefono_persona_contacto_3', 'email_persona_contacto_3',
            'cargo_persona_contacto_3'], 'filter', 'filter' => 'strtoupper'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario',
            'nombre' => 'Nombre',
            'tipo_documento' => 'Tipo de documento',
            'documento' => 'Documento',
            'direccion' => 'Dirección física',
            'nombre_representante_legal' => 'Nombres',
            'telefono_representante_legal' => 'Teléfonos',
            'email_representante_legal' => 'Correo electrónico',
            'nombre_persona_contacto_1' => 'Nombres',
            'telefono_persona_contacto_1' => 'Teléfonos',
            'email_persona_contacto_1' => 'Correo electrónico',
            'cargo_persona_contacto_1' => 'Cargo',
            'nombre_persona_contacto_2' => 'Nombres',
            'telefono_persona_contacto_2' => 'Teléfonos',
            'email_persona_contacto_2' => 'Correo electrónico',
            'cargo_persona_contacto_2' => 'Cargo',
            'nombre_persona_contacto_3' => 'Nombres',
            'telefono_persona_contacto_3' => 'Teléfonos',
            'email_persona_contacto_3' => 'Correo electrónico',
            'cargo_persona_contacto_3' => 'Cargo',
            'carpeta' => 'Carpeta Google Drive',
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario() {
        return $this->hasOne(Users::className(), ['id' => 'usuario_id']);
    }

    /**
     * Gets query for [[Liquidaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLiquidaciones() {
        return $this->hasMany(Liquidaciones::className(), ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['cliente_id' => 'id']);
    }

}
