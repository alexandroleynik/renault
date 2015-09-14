<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Block;

/**
 * BlockSearch represents the model behind the search form about `common\models\Block`.
 */
class BlockSearch extends Block
{

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
        $query = Block::find();

        if (!\Yii::$app->user->can('administrator')) {
            $query->forDomain();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'        => $this->id,
            'slug'      => $this->slug,
            'status'    => $this->status,
            'domain_id' => $this->domain_id,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'before_body', $this->before_body])
            ->andFilterWhere(['like', 'after_body', $this->after_body])
            ->andFilterWhere(['like', 'on_scenario', $this->on_scenario]);
        ;

        return $dataProvider;
    }
}