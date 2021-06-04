<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportTemp;

/**
 * ReportTempSearch represents the model behind the search form of `app\models\ReportTemp`.
 */
class ReportTempSearch extends ReportTemp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['col1', 'col2', 'col3', 'col4', 'col5', 'col6', 'col7', 'col8', 'col9', 'col10', 'col11', 'col12', 'col13', 'col14', 'col15', 'col16', 'col17'], 'safe'],
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
        $query = ReportTemp::find();

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
        ]);

        $query->andFilterWhere(['like', 'col1', $this->col1])
            ->andFilterWhere(['like', 'col2', $this->col2])
            ->andFilterWhere(['like', 'col3', $this->col3])
            ->andFilterWhere(['like', 'col4', $this->col4])
            ->andFilterWhere(['like', 'col5', $this->col5])
            ->andFilterWhere(['like', 'col6', $this->col6])
            ->andFilterWhere(['like', 'col7', $this->col7])
            ->andFilterWhere(['like', 'col8', $this->col8])
            ->andFilterWhere(['like', 'col9', $this->col9])
            ->andFilterWhere(['like', 'col10', $this->col10])
            ->andFilterWhere(['like', 'col11', $this->col11])
            ->andFilterWhere(['like', 'col12', $this->col12])
            ->andFilterWhere(['like', 'col13', $this->col13])
            ->andFilterWhere(['like', 'col14', $this->col14])
            ->andFilterWhere(['like', 'col15', $this->col15])
            ->andFilterWhere(['like', 'col16', $this->col16])
            ->andFilterWhere(['like', 'col17', $this->col17]);

        return $dataProvider;
    }
}
