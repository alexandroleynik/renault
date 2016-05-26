<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{

    public $author;
    public $search_date_published;
    public $data_end_published;
    public $data_begin_published;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'author_id', 'updater_id', 'status', 'published_at', 'created_at', 'updated_at', 'domain_id'], 'integer'],
            [['slug', 'title', 'body', 'weight', 'before_body', 'after_body', 'on_scenario','author', 'search_date_published', 'data_end_published', 'data_begin_published'], 'safe'],
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
        $query = Article::find();

        $query->joinWith(['author']);

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
            'id'           => $this->id,
            'slug'         => $this->slug,
            //'author_id'    => $this->author_id,
            'category_id'  => $this->category_id,
            'updater_id'   => $this->updater_id,
            'status'       => $this->status,
            // 'published_at' => $this->published_at,
            // 'created_at'   => $this->created_at,
            // 'updated_at'   => $this->updated_at,
            'domain_id'    => $this->domain_id
        ]);

        if ($this->search_date_published != '') {
            $this->data_begin_published = strtotime($this->search_date_published);
            $this->data_end_published   = strtotime($this->search_date_published) + (24*60*60);
        }

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'before_body', $this->before_body])
            ->andFilterWhere(['like', 'after_body', $this->after_body])
            ->andFilterWhere(['like', 'user.username', $this->author])
            ->andFilterWhere(['between', 'article.published_at', $this->data_begin_published, $this->data_end_published])
            ->andFilterWhere(['like', 'on_scenario', $this->on_scenario]);

        return $dataProvider;
    }
}