<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\FinancePage;
use yii\db\ActiveQuery;

class FinancePageQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%finance_page}}.status' => FinancePage::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%finance_page}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{finance_page_categories}}', '{{finance_page_categories}}.finance_page_id = {{%finance_page}}.id');
            $this->andWhere('{{finance_page_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function firstFinancePage($mid)
    {
        if (!empty($mid)) {
            $this->andWhere('{{finance_page.model_id}} = "' . $mid . '"');
            $this->orderBy('{{finance_page.weight}}');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%finance_page.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}