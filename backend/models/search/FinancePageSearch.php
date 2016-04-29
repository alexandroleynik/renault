<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FinancePage;

/**
 * FinancePageSearch represents the model behind the search form finance `common\models\FinancePage`.
 */
class FinancePageSearch extends FinancePage
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'author_id', 'updater_id', 'status', 'published_at', 'created_at', 'updated_at', 'domain_id'], 'integer'],
            [['slug', 'title', 'body', 'weight', 'before_body', 'after_body', 'on_scenario'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FinancePage::find();

        if (!\Yii::$app->user->can('administrator')) {
            $query->forDomain();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!empty($params['mid'])) {
            $query->andFilterWhere(['finance_id' => intval($params['mid'])]);
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'           => $this->id,
            'author_id'    => $this->author_id,
            'category_id'  => $this->category_id,
            'finance_id'     => $this->finance_id,
            'updater_id'   => $this->updater_id,
            'status'       => $this->status,
            'published_at' => $this->published_at,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'domain_id'    => $this->domain_id
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'before_body', $this->before_body])
            ->andFilterWhere(['like', 'after_body', $this->after_body])
            ->andFilterWhere(['like', 'on_scenario', $this->on_scenario]);

        return $dataProvider;
    }
}