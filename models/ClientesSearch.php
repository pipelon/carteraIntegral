<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `app\models\Clientes`.
 */
class ClientesSearch extends Clientes {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['tipo_documento', 'nombre', 'documento', 'direccion', 'nombre_persona_contacto_1', 'telefono_persona_contacto_1', 'email_persona_contacto_1', 'cargo_persona_contacto_1', 'nombre_persona_contacto_2', 'telefono_persona_contacto_2', 'email_persona_contacto_2', 'cargo_persona_contacto_2', 'nombre_persona_contacto_3', 'telefono_persona_contacto_3', 'email_persona_contacto_3', 'cargo_persona_contacto_3', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Clientes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'tipo_documento', $this->tipo_documento])
                ->andFilterWhere(['like', 'documento', $this->documento])
                ->andFilterWhere(['like', 'nombre', $this->nombre])
                ->andFilterWhere(['like', 'direccion', $this->direccion])
                ->andFilterWhere(['like', 'nombre_persona_contacto_1', $this->nombre_persona_contacto_1])
                ->andFilterWhere(['like', 'telefono_persona_contacto_1', $this->telefono_persona_contacto_1])
                ->andFilterWhere(['like', 'email_persona_contacto_1', $this->email_persona_contacto_1])
                ->andFilterWhere(['like', 'cargo_persona_contacto_1', $this->cargo_persona_contacto_1])
                ->andFilterWhere(['like', 'nombre_persona_contacto_2', $this->nombre_persona_contacto_2])
                ->andFilterWhere(['like', 'telefono_persona_contacto_2', $this->telefono_persona_contacto_2])
                ->andFilterWhere(['like', 'email_persona_contacto_2', $this->email_persona_contacto_2])
                ->andFilterWhere(['like', 'cargo_persona_contacto_2', $this->cargo_persona_contacto_2])
                ->andFilterWhere(['like', 'nombre_persona_contacto_3', $this->nombre_persona_contacto_3])
                ->andFilterWhere(['like', 'telefono_persona_contacto_3', $this->telefono_persona_contacto_3])
                ->andFilterWhere(['like', 'email_persona_contacto_3', $this->email_persona_contacto_3])
                ->andFilterWhere(['like', 'cargo_persona_contacto_3', $this->cargo_persona_contacto_3])
                ->andFilterWhere(['like', 'created_by', $this->created_by])
                ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }

}
