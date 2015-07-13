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
            $this->andWhere('{{promo_categories.category_id}} = "'.$ids.'"');
        }

        return $this;
    }

}