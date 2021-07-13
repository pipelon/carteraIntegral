<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Deudores;

/**
 * DeudoresSearch represents the model behind the search form of `app\models\Deudores`.
 */
class DeudoresSearch extends Deudores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'marca', 'direccion', 'nombre_persona_contacto_1', 'telefono_persona_contacto_1', 'email_persona_contacto_1', 'cargo_persona_contacto_1', 'nombre_persona_contacto_2', 'telefono_persona_contacto_2', 'email_persona_contacto_2', 'cargo_persona_contacto_2', 'nombre_persona_contacto_3', 'telefono_persona_contacto_3', 'email_persona_contacto_3', 'cargo_persona_contacto_3', 'nombre_codeudor_1', 'documento_codeudor_1', 'direccion_codeudor_1', 'email_codeudor_1', 'telefono_codeudor_1', 'nombre_codeudor_2', 'documento_codeudor_2', 'direccion_codeudor_2', 'email_codeudor_2', 'telefonol_codeudor_2', 'comentarios', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Deudores::find();

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

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'marca', $this->marca])
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
            ->andFilterWhere(['like', 'nombre_codeudor_1', $this->nombre_codeudor_1])
            ->andFilterWhere(['like', 'documento_codeudor_1', $this->documento_codeudor_1])
            ->andFilterWhere(['like', 'direccion_codeudor_1', $this->direccion_codeudor_1])
            ->andFilterWhere(['like', 'email_codeudor_1', $this->email_codeudor_1])
            ->andFilterWhere(['like', 'telefono_codeudor_1', $this->telefono_codeudor_1])
            ->andFilterWhere(['like', 'nombre_codeudor_2', $this->nombre_codeudor_2])
            ->andFilterWhere(['like', 'documento_codeudor_2', $this->documento_codeudor_2])
            ->andFilterWhere(['like', 'direccion_codeudor_2', $this->direccion_codeudor_2])
            ->andFilterWhere(['like', 'email_codeudor_2', $this->email_codeudor_2])
            ->andFilterWhere(['like', 'telefonol_codeudor_2', $this->telefonol_codeudor_2])
            ->andFilterWhere(['like', 'comentarios', $this->comentarios])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
