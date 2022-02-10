<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurisdiccionesCompetentes;

/**
 * JurisdiccionesCompetentesSearch represents the model behind the search form of `app\models\JurisdiccionesCompetentes`.
 */
class JurisdiccionesCompetentesSearch extends JurisdiccionesCompetentes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ciudad_id', 'codigo_entidad', 'codigo_especialidad', 'despacho', 'delete'], 'integer'],
            [['entidad', 'especialidad', 'nombre', 'created', 'created_by', 'modified', 'modified_by', 'deleted', 'deleted_by'], 'safe'],
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
        $query = JurisdiccionesCompetentes::find();

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
            'ciudad_id' => $this->ciudad_id,
            'codigo_entidad' => $this->codigo_entidad,
            'codigo_especialidad' => $this->codigo_especialidad,
            'despacho' => $this->despacho,
            'created' => $this->created,
            'modified' => $this->modified,
            'delete' => $this->delete,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'entidad', $this->entidad])
            ->andFilterWhere(['like', 'especialidad', $this->especialidad])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
