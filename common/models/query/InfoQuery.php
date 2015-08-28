<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Info;
use yii\db\ActiveQuery;

class InfoQuery extends ActiveQuery
{

    public function published()
    {
        $this->andWhere(['{{%info}}.status' => Info::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%info}}.published_at', time()]);
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function onlyCategory($ids)
    {
        if (!empty($ids)) {
            $this->leftJoin('{{info_categories}}', '{{info_categories}}.info_id = {{%info}}.id');
            $this->andWhere('{{info_categories.category_id}} = "' . $ids . '"');
        }

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function firstInfo($mid)
    {
        if (!empty($mid)) {
            $this->andWhere('{{info.model_id}} = "' . $mid . '"');
            $this->orderBy('{{info.weight}}');
        }

        return $this;
    }

    public function forDomain()
    {
        $this->andWhere('{{%info.domain_id}} = "' . \Yii::$app->user->identity->domain_id . '"');

        return $this;
    }
}