<?php

namespace backend\models\search;

use Yii;
use yii\base\Model as BaseModel;
use yii\data\ActiveDataProvider;
use common\models\Emailf;

/**
 * AboutSearch represents the model behind the search form about `common\models\About`.
 */
class EmailfSearch extends Emailf
{

    public $search_date_created;
    public $data_end_created;
    public $data_begin_created;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'created_at', 'updated_at', 'domain_id'], 'integer'],
            [['email', 'search_date_created', 'data_begin_created', 'data_end_created'], 'safe'],
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
        $query = Emailf::find();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'           => $this->id,
            'status'       => $this->status,

            // 'created_at'   => $this->created_at,
            // 'updated_at'   => $this->updated_at,
            'domain_id'    => $this->domain_id
        ]);

        if ($this->search_date_created != '') {
            $this->data_begin_created = strtotime($this->search_date_created);
            $this->data_end_created   = strtotime($this->search_date_created) + (24*60*60);
        }

        $query->andFilterWhere(['like', 'email', $this->email])->andFilterWhere(['between', 'created_at', $this->data_begin_created, $this->data_end_created]);

        return $dataProvider;
    }
}