<?php

namespace backend\models\search;

use Yii;
use yii\base\Model as BaseModel;
use yii\data\ActiveDataProvider;
use common\models\Feedback;

/**
 * AboutSearch represents the model behind the search form about `common\models\About`.
 */
class FeedbackSearch extends Feedback
{

    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'created_at', 'updated_at', 'domain_id'], 'integer'],
            [['text', 'subject', 'author'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return BaseModel::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Feedback::find();
        $query->joinWith(['author']);

        if (!\Yii::$app->user->can('administrator')) {
            $query->andWhere(['domain_id' => \Yii::$app->user->identity->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'           => $this->id,
            'status'       => $this->status,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'domain_id'    => $this->domain_id
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'user.username', $this->author]);

        return $dataProvider;
    }
}