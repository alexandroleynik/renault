<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Promo;
use yii\db\ActiveQuery;

class PromoQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%promo}}.status' => Promo::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%promo}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{promo_categories}}', '{{promo_categories}}.promo_id = {{%promo}}.id');
            $this->andWhere('{{promo_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{promo.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }

    public function localeGroupPages($model)
    {
        $this->multiple = true;
        $this->select(['id', 'slug', 'title', 'locale']);
        $this->published();
        $this->andWhere($model->tableName() . '.domain_id = "' . $model->domain_id . '"');
        $this->andWhere($model->tableName() . '.locale_group_id = "' . $model->locale_group_id . '"');

        return $this;
    }
}