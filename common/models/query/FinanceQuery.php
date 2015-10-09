<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Finance;
use yii\db\ActiveQuery;

class FinanceQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%finance}}.status' => Finance::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%finance}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{finance_categories}}', '{{finance_categories}}.finance_id = {{%finance}}.id');
            $this->andWhere('{{finance_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%finance.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}