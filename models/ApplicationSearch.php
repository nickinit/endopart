<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;

/**
 * ApplicationSearch - модель для поиска по модели `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    public $serno;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'breakdown_date', 'repair_period'], 'integer'],
            ['serno', 'safe'],
            [['equipment_id', 'status_id', 'structure_id', 'problem', 'place'], 'safe'],
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
     * Создает провайдер данных с условиями поиска
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Application::find();
        $query->joinWith(['equipment']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Опции фильтрации
        $query->andFilterWhere([
            'id' => $this->id,
            'breakdown_date' => $this->breakdown_date,
            'repair_period' => $this->repair_period,
        ]);

        $query->andFilterWhere(['like', 'equipment_id', $this->equipment_id])
            ->andFilterWhere(['like', 'status_id', $this->status_id])
            ->andFilterWhere(['like', 'equipment.serno', $this->serno])
            ->andFilterWhere(['like', 'structure_id', $this->structure_id])
            ->andFilterWhere(['like', 'problem', $this->problem])
            ->andFilterWhere(['like', 'place', $this->place]);

        return $dataProvider;
    }


}
