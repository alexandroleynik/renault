<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Domain;

/**
 * DomainSearch represents the model behind the search form about `common\models\Domain`.
 */
class DomainSearch extends Domain
{

    public $search_date_created;
    public $data_end_created;
    public $data_begin_created;
    public $search_date_updated;
    public $data_begin_updated;
    public $data_end_updated;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status','av_locale', 'locale_group_id', 'dealer_id'], 'integer'],
            [['title', 'description', 'locale', 'search_date_updated','search_date_created', 'data_begin_updated', 'data_end_updated', 'data_begin_created', 'data_end_created'], 'safe'],
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
        $query = Domain::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['search_date_created'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['created_at' => SORT_ASC],
            'desc' => ['created_at' => SORT_DESC],
        ];

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['search_date_updated'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['updated_at' => SORT_ASC],
            'desc' => ['updated_at' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'status' => $this->status,
            'locale_group_id' => $this->locale_group_id,
            'dealer_id' => $this->dealer_id,
        ]);

        if ($this->search_date_created != '') {
            $this->data_begin_created = strtotime($this->search_date_created);
            $this->data_end_created   = strtotime($this->search_date_created) + (24*60*60);
        }

        if ($this->search_date_updated != '') {
            $this->data_begin_updated = strtotime($this->search_date_updated);
            $this->data_end_updated   = strtotime($this->search_date_updated) + (24*60*60);
        }
        

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['between', 'created_at', $this->data_begin_created, $this->data_end_created])
            ->andFilterWhere(['between', 'updated_at', $this->data_begin_updated, $this->data_end_updated])
            ->andFilterWhere(['like', 'locale', $this->locale]);

        return $dataProvider;
    }
}
