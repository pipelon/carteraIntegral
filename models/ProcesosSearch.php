<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Procesos;

/**
 * ProcesosSearch represents the model behind the search form of `app\models\Procesos`.
 */
class ProcesosSearch extends Procesos {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'cliente_id', 'deudor_id'], 'integer'],
            [['prejur_valor_activacion', 'prejur_saldo_actual',
            'jur_valor_activacion', 'jur_saldo_actual'], 'number'],
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
        $query = Procesos::find();

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
            'cliente_id' => $this->cliente_id,
            'deudor_id' => $this->deudor_id
        ]);

        $query->andFilterWhere(['like', 'prejur_valor_activacion', $this->prejur_valor_activacion])
                ->andFilterWhere(['like', 'prejur_saldo_actual', $this->prejur_saldo_actual])
                ->andFilterWhere(['like', 'jur_valor_activacion', $this->jur_valor_activacion])
                ->andFilterWhere(['like', 'jur_saldo_actual', $this->jur_saldo_actual]);

        return $dataProvider;
    }

}
