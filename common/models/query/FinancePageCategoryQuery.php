<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\FinancePageCategory;
use yii\db\ActiveQuery;

class FinancePageCategoryQuery extends ActiveQuery
{

    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['{{%finance_page_category}}.status' => FinancePageCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%finance_page_category}}.parent_id IS NULL');

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%finance_page_category}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%finance_page_category.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}