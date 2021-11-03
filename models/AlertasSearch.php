<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alertas;

/**
 * AlertasSearch represents the model behind the search form of `app\models\Alertas`.
 */
class AlertasSearch extends Alertas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proceso_id', 'usuario_id'], 'integer'],
            [['descripcion_alerta', 'pausada', 'fecha_pausada', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
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
        $query = Alertas::find();

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
            'proceso_id' => $this->proceso_id,
            'usuario_id' => $this->usuario_id,
            'fecha_pausada' => $this->fecha_pausada,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'descripcion_alerta', $this->descripcion_alerta])
            ->andFilterWhere(['like', 'pausada', $this->pausada])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
