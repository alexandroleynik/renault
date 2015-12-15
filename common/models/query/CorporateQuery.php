<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Corporate;
use yii\db\ActiveQuery;

class CorporateQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%corporate_sales}}.status' => Corporate::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%corporate_sales}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%corporate_sales.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }


}