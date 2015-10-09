<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\FinanceCategory;
use yii\db\ActiveQuery;

class FinanceCategoryQuery extends ActiveQuery
{

    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['{{%finance_category}}.status' => FinanceCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%finance_category}}.parent_id IS NULL');

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%finance_category}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%finance_category.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}