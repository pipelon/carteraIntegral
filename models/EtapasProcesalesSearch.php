<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EtapasProcesales;

/**
 * EtapasProcesalesSearch represents the model behind the search form of `app\models\EtapasProcesales`.
 */
class EtapasProcesalesSearch extends EtapasProcesales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_proceso_id', 'activo', 'delete'], 'integer'],
            [['nombre', 'created', 'created_by', 'modified', 'modified_by', 'deleted', 'deleted_by'], 'safe'],
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
        $query = EtapasProcesales::find();

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
            'tipo_proceso_id' => $this->tipo_proceso_id,
            'activo' => $this->activo,
            'delete' => $this->delete,
            'created' => $this->created,
            'modified' => $this->modified,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
