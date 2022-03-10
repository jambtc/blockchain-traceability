<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LotsHash;

/**
 * LotsHashSearch represents the model behind the search form of `app\models\LotsHash`.
 */
class LotsHashSearch extends LotsHash
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lot_id'], 'integer'],
            [['hash', 'txhash'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = LotsHash::find()
            ->joinWith('lot');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'lot_id' => $this->lot_id,
        ]);

        $query->andFilterWhere(['like', 'hash', $this->hash])
            ->andFilterWhere(['like', 'txhash', $this->txhash]);

        return $dataProvider;
    }
}
