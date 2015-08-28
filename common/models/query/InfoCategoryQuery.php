<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\InfoCategory;
use yii\db\ActiveQuery;

class InfoCategoryQuery extends ActiveQuery
{

    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['{{%info_category}}.status' => InfoCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%info_category}}.parent_id IS NULL');

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function ignore($ids)
    {
        $this->andWhere('{{%info_category}}.id NOT IN (' . $ids . ')');

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%info_category.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}