<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personas;

/**
 * PersonasSearch represents the model behind the search form of `app\models\Personas`.
 */
class PersonasSearch extends Personas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nit', 'digverifica', 'representantelegal'], 'integer'],
            [['tipodeudor', 'firstname', 'lastname', 'razonsocial', 'direccion', 'telefonofijo', 'celular', 'email', 'ciudad', 'marcas', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
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
        $query = Personas::find();

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
            'nit' => $this->nit,
            'digverifica' => $this->digverifica,
            'representantelegal' => $this->representantelegal,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'tipodeudor', $this->tipodeudor])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'razonsocial', $this->razonsocial])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefonofijo', $this->telefonofijo])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'marcas', $this->marcas])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
