<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Info;

/**
 * InfoSearch represents the model behind the search form about `common\models\Info`.
 */
class InfoSearch extends Info
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'author_id', 'updater_id', 'status', 'published_at', 'created_at', 'updated_at', 'model_id', 'domain_id'], 'integer'],
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
        $query = Info::find();

        if (!\Yii::$app->user->can('administrator')) {
            $query->forDomain();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!empty($params['mid'])) {
            $query->andFilterWhere(['model_id' => intval($params['mid'])]);
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'info.id'           => $this->id,
            'info.author_id'    => $this->author_id,
            'info.category_id'  => $this->category_id,
            'info.model_id'     => $this->model_id,
            'info.updater_id'   => $this->updater_id,
            'info.status'       => $this->status,
            'info.published_at' => $this->published_at,
            'info.created_at'   => $this->created_at,
            'info.updated_at'   => $this->updated_at,
            'info.domain_id'    => $this->domain_id
        ]);

        $query->andFilterWhere(['like', 'info.slug', $this->slug])
            ->andFilterWhere(['like', 'info.title', $this->title])
            ->andFilterWhere(['like', 'info.description', $this->description])
            ->andFilterWhere(['like', 'info.weight', $this->weight])
            ->andFilterWhere(['like', 'info.body', $this->body])
            ->andFilterWhere(['like', 'info.before_body', $this->before_body])
            ->andFilterWhere(['like', 'info.after_body', $this->after_body])
            ->andFilterWhere(['like', 'info.on_scenario', $this->on_scenario]);

        if (!empty($params['InfoSearch']['cid'])) {
            $query->onlyModelCategory($params['InfoSearch']['cid']);
        }

        return $dataProvider;
    }
}