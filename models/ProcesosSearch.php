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

    public $buscador;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['buscador'], 'string', 'max' => 200]
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
        $query->joinWith(['cliente', 'deudor', 'estadoProceso', 'jurJurisdiccionCompetent']);

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
        /* $query->andFilterWhere([
          'id' => $this->id,
          'cliente_id' => $this->cliente_id,
          'deudor_id' => $this->deudor_id,
          'estado_proceso_id' => $this->estado_proceso_id
          ]); */

        /* $query->andFilterWhere(['like', 'prejur_valor_activacion', $this->prejur_valor_activacion])
          ->andFilterWhere(['like', 'prejur_saldo_actual', $this->prejur_saldo_actual])
          ->andFilterWhere(['like', 'jur_valor_activacion', $this->jur_valor_activacion])
          ->andFilterWhere(['like', 'jur_saldo_actual', $this->jur_saldo_actual]); */

        $query->andFilterWhere(['like', 'clientes.nombre', trim($this->buscador)])
                ->orFilterWhere(['like', 'clientes.documento', trim($this->buscador)])
                ->orFilterWhere(['like', 'deudores.nombre', trim($this->buscador)])
                ->orFilterWhere(['like', 'deudores.documento', trim($this->buscador)])
                ->orFilterWhere(['like', 'estados_proceso.nombre', trim($this->buscador)])
                ->orFilterWhere(['like', 'jurisdicciones_competentes.nombre', trim($this->buscador)])
                ->orFilterWhere(['like', 'jur_radicado', trim($this->buscador)])
                ->orFilterWhere(['like', 'jur_radicado_2', trim($this->buscador)])
                ->orFilterWhere(['like', 'jur_radicado_3', trim($this->buscador)]);

        // SI EL USUARIO LOGUEADO ES CLIENTE, SOLO VE SU INFO
        if (Yii::$app->user->identity->isCliente()) {
            $clientesIds = Yii::$app->user->identity->getClientsByUser();
            $ids = array_column($clientesIds, 'id'); #91001400300120100052300
            $query->andFilterWhere(['in', 'cliente_id', $ids]);
        }

        return $dataProvider;
    }

}
