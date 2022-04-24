<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TiposAlertas;

/**
 * TiposAlertasSearch represents the model behind the search form of `app\models\TiposAlertas`.
 */
class TiposAlertasSearch extends TiposAlertas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_alerta_id', 'dias_para_alerta', 'depende_de_etapa_1', 'depende_de_etapa_2'], 'integer'],
            [['asunto', 'descripcion', 'activa', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
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
        $query = TiposAlertas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tipo_alerta_id' => $this->tipo_alerta_id,
            'dias_para_alerta' => $this->dias_para_alerta,
            'depende_de_etapa_1' => $this->depende_de_etapa_1,
            'depende_de_etapa_2' => $this->depende_de_etapa_2,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'asunto', $this->asunto])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'activa', $this->activa])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
