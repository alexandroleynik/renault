<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Price;
use yii\db\ActiveQuery;

class PriceQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%price}}.status' => Price::STATUS_PUBLISHED]);
//        $this->andWhere(['<', '{{%price}}.published_at', time()]);
//        $this->orderBy('{{%price}}.weight');
        return $this;
    }

    /**
     *
     * @return $this
     */


    public function forDomain()
    {
        $this->andWhere('{{%price.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }

    public function localeGroupPages($model)
    {
        $this->multiple = true;
        $this->select(['id', 'model', 'version', 'locale']);
        $this->published();
        $this->andWhere($model->tableName() . '.domain_id = "' . $model->domain_id . '"');
        $this->andWhere($model->tableName() . '.locale_group_id = "' . $model->locale_group_id . '"');

        return $this;
    }
}