<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{

    public $search_date_created;
    public $search_date_logged;
    public $data_begin_logged;
    public $data_end_logged;
    public $data_end_created;
    public $data_begin_created;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'logged_at', 'domain_id'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'],'safe'],
            [['search_date_logged','search_date_created', 'data_begin_logged', 'data_end_logged', 'data_begin_created', 'data_end_created'], 'safe']
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
        $query = User::find();

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
        $dataProvider->sort->attributes['search_date_logged'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['logged_at' => SORT_ASC],
            'desc' => ['logged_at' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'         => $this->id,
            'status'     => $this->status,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            //'logged_at'  => $this->logged_at,
            'domain_id'  => $this->domain_id
        ]);

        if ($this->search_date_created != '') {
            $this->data_begin_created = strtotime($this->search_date_created);
            $this->data_end_created   = strtotime($this->search_date_created) + (24*60*60);
        }

        if ($this->search_date_logged != '') {
            $this->data_begin_logged = strtotime($this->search_date_logged);
            $this->data_end_logged   = strtotime($this->search_date_logged) + (24*60*60);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['between', 'created_at', $this->data_begin_created, $this->data_end_created])
            ->andFilterWhere(['between', 'logged_at', $this->data_begin_logged, $this->data_end_logged])
            ->andFilterWhere(['like', 'email', $this->email]);


        return $dataProvider;
    }
}