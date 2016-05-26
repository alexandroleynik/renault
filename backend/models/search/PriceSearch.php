<?php

namespace backend\models\search;

use Yii;
use yii\base\Model as BaseModel;
use yii\data\ActiveDataProvider;
use common\models\Price;

/**
 * ModelSearch represents the model behind the search form about `common\models\Model`.
 */
class PriceSearch extends Price
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
//        'id'         => Schema::TYPE_PK,
//            'model' => Schema::TYPE_STRING . '(512)',
//            'version'      => Schema::TYPE_STRING . '(512)',
//            'version_code'       => Schema::TYPE_STRING . '(512)',
//            'body_type'       => Schema::TYPE_STRING . '(512)',
//            'price'       => Schema::TYPE_STRING . '(512)',
//            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
//            'created_at' => Schema::TYPE_INTEGER,
//            'updated_at' => Schema::TYPE_INTEGER,
//            'weight'     => Schema::TYPE_SMALLINT,
//            'locale'             => Schema::TYPE_STRING,
//            'locale_group_id'    => Schema::TYPE_INTEGER,
//            'domain_id'  => Schema::TYPE_INTEGER,
        return [
            [['id', 'status',  'created_at', 'updated_at', 'domain_id'], 'integer'],
            [['model', 'version','version_code', 'body_type', 'weight', 'price'], 'safe'],
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
        $query = Price::find();

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
            '{{price}}.id'           => $this->id,
            '{{price}}.model'         => $this->model,
            '{{price}}.version'    => $this->version,
            '{{price}}.version_code'  => $this->version_code,
            '{{price}}.body_type'   => $this->body_type,
            '{{price}}.price'   => $this->price,

            '{{price}}.status'       => $this->status,
//            '{{price}}.published_at' => $this->published_at,
            '{{price}}.created_at'   => $this->created_at,
            '{{price}}.updated_at'   => $this->updated_at,
            '{{price}}.domain_id'    => $this->domain_id
        ]);
//        'id'         => Schema::TYPE_PK,
//            'model' => Schema::TYPE_STRING . '(512)',
//            'version'      => Schema::TYPE_STRING . '(512)',
//            'version_code'       => Schema::TYPE_STRING . '(512)',
//            'body_type'       => Schema::TYPE_STRING . '(512)',
//            'price'       => Schema::TYPE_STRING . '(512)',
//            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
//            'created_at' => Schema::TYPE_INTEGER,
//            'updated_at' => Schema::TYPE_INTEGER,
//            'weight'     => Schema::TYPE_SMALLINT,
//            'locale'             => Schema::TYPE_STRING,
//            'locale_group_id'    => Schema::TYPE_INTEGER,
//            'domain_id'  => Schema::TYPE_INTEGER,
        $query->andFilterWhere(['like', '{{model}}.model', $this->model])
            ->andFilterWhere(['like', '{{model}}.version', $this->version])
            ->andFilterWhere(['like', '{{model}}.price', $this->title])
            ->andFilterWhere(['like', '{{model}}.version_code', $this->version_code])
            ->andFilterWhere(['like', '{{model}}.weight', $this->weight])
            ->andFilterWhere(['like', '{{model}}.body_type', $this->body_type]);


        if (!empty($params['PriceSearch']['cid'])) {
            $query->onlyCategory($params['PriceSearch']['cid']);
        }

        return $dataProvider;
    }
}