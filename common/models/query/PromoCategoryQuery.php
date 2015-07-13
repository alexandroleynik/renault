<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\PromoCategory;
use yii\db\ActiveQuery;

class PromoCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['{{%promo_category}}.status' => PromoCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%promo_category}}.parent_id IS NULL');

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%promo_category}}.id NOT IN (' . $ids . ')');

        return $this;
    }
}
